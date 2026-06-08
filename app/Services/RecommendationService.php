<?php

namespace App\Services;

use App\Models\RbfRule;
use App\Models\SawWeight;
use App\Models\SawCriteriaScore;
use App\Models\WashingStep;
use App\Models\DetergentRecommendation;

class RecommendationService
{
    public function getRecommendation($input)
    {
        $allMethods = ['M1', 'M2', 'M3', 'M4', 'M5'];
        $excludedMethods = [];

        // 1. Rule-Based Filtering (RBF)
        $rules = RbfRule::where('is_active', true)->get();
        foreach ($rules as $rule) {
            $match = true;

            if ($rule->fabric && $rule->fabric !== $input['fabric_type']) $match = false;
            if ($rule->color && $rule->color !== $input['color']) $match = false;
            if ($rule->motif && $rule->motif !== $input['pattern']) $match = false;
            if ($rule->dirt_level && $rule->dirt_level !== $input['dirt_level']) $match = false;

            if ($match) {
                if (!in_array($rule->eliminated_method, $excludedMethods)) {
                    $excludedMethods[] = $rule->eliminated_method;
                }
            }
        }

        $remainingMethods = array_diff($allMethods, $excludedMethods);
        
        // Overrides and Exceptions (Relaksasi Aturan) per Dokumen v3.0
        
        // 1. Batik printing modern / batik cap pabrik
        if (isset($input['is_batik_printing']) && $input['is_batik_printing']) {
            // Relaksasi R11 & R12: M4 (Mesin halus) diizinkan
            if (!in_array('M4', $remainingMethods)) {
                $remainingMethods[] = 'M4';
            }
        }

        // 2. Rayon campuran >= 50% poliester (rayon-poly blend)
        if (isset($input['is_polyester_blend']) && $input['is_polyester_blend'] && $input['fabric_type'] === 'Rayon') {
            // Relaksasi R02 & R03: M4 (Mesin halus) diizinkan
            if (!in_array('M4', $remainingMethods)) {
                $remainingMethods[] = 'M4';
            }
        }

        // 3. Denim baru (< 5 kali cuci)
        if (isset($input['is_denim_new']) && $input['is_denim_new'] && $input['fabric_type'] === 'Denim') {
            // Tambah eliminasi M3 (Mesin normal) meski kriteria lain membolehkan
            $remainingMethods = array_diff($remainingMethods, ['M3']);
        }

        // 4. Sablon rubber/karet (lebih sensitif)
        if (isset($input['is_sablon_rubber']) && $input['is_sablon_rubber'] && $input['pattern'] === 'Sablon/Bordir') {
            // R13 dan R14 lebih ketat; tambah eliminasi M4 (Mesin halus)
            $remainingMethods = array_diff($remainingMethods, ['M4']);
        }

        // 5. Bordir pada area kecil (< 10% permukaan)
        if (isset($input['is_bordir_small']) && $input['is_bordir_small'] && $input['pattern'] === 'Sablon/Bordir') {
            // R14 dapat direlaksasi untuk M4 (Mesin halus)
            if (!in_array('M4', $remainingMethods)) {
                // Pastikan M4 tidak diblokir oleh aturan lain yang lebih kuat (seperti sablon rubber)
                if (!(isset($input['is_sablon_rubber']) && $input['is_sablon_rubber'])) {
                    $remainingMethods[] = 'M4';
                }
            }
        }

        if (empty($remainingMethods)) {
            $remainingMethods = $allMethods; // Fallback if all excluded
        }

        // 2. Simple Additive Weighting (SAW)
        $weights = SawWeight::all()->pluck('weight', 'criterion_code')->toArray();
        $criteria = ['C1', 'C2', 'C3', 'C4'];
        
        $matrix = [];
        foreach ($remainingMethods as $m) {
            foreach ($criteria as $c) {
                $attrValue = $this->getAttrValueByCriteria($c, $input);
                $score = SawCriteriaScore::where('method_code', $m)
                    ->where('criterion_code', $c)
                    ->where('attribute_value', $attrValue)
                    ->first();
                
                $matrix[$m][$c] = $score ? $score->score : 0;
            }
        }

        // Normalization
        $normalizedMatrix = [];
        foreach ($criteria as $c) {
            $maxScore = 0;
            foreach ($remainingMethods as $m) {
                if ($matrix[$m][$c] > $maxScore) {
                    $maxScore = $matrix[$m][$c];
                }
            }

            foreach ($remainingMethods as $m) {
                $normalizedMatrix[$m][$c] = $maxScore > 0 ? ($matrix[$m][$c] / $maxScore) : 0;
            }
        }

        // Final Score Calculation
        $finalScores = [];
        foreach ($remainingMethods as $m) {
            $total = 0;
            foreach ($criteria as $c) {
                $total += $normalizedMatrix[$m][$c] * ($weights[$c] ?? 0);
            }
            $finalScores[$m] = $total;
        }

        arsort($finalScores);

        $results = [];
        foreach ($finalScores as $m => $score) {
            $results[] = [
                'method_code' => $m,
                'method_name' => $this->getMethodName($m),
                'score' => $score,
                'steps' => WashingStep::where('method_code', $m)->orderBy('step_order')->get(),
                'detergents' => DetergentRecommendation::where('method_code', $m)->get(),
            ];
        }

        return $results;
    }

    private function getAttrValueByCriteria($c, $input)
    {
        switch ($c) {
            case 'C1': return $input['fabric_type'];
            case 'C2': return $input['pattern'];
            case 'C3': return $input['dirt_level'];
            case 'C4': return $input['color'];
            default: return '';
        }
    }

    private function getMethodName($m)
    {
        $names = [
            'M1' => 'Cuci tangan dengan air dingin',
            'M2' => 'Cuci tangan dengan air hangat',
            'M3' => 'Mesin cuci mode normal',
            'M4' => 'Mesin cuci mode halus / delicate',
            'M5' => 'Dry cleaning',
        ];
        return $names[$m] ?? $m;
    }
}
