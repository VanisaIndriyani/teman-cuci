<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SawCriteriaScore;
use Illuminate\Http\Request;

class SawCriteriaScoreController extends Controller
{
    public function index(Request $request)
    {
        $criteria = [
            'C1' => 'Jenis Kain',
            'C2' => 'Motif',
            'C3' => 'Tingkat Kekotoran',
            'C4' => 'Warna',
        ];

        $methods = ['M1', 'M2', 'M3', 'M4', 'M5'];
        $selectedCriterion = $request->get('criterion', 'C1');

        if (!array_key_exists($selectedCriterion, $criteria)) {
            $selectedCriterion = 'C1';
        }

        $attributeValues = SawCriteriaScore::query()
            ->where('criterion_code', $selectedCriterion)
            ->select('attribute_value')
            ->distinct()
            ->orderBy('attribute_value')
            ->pluck('attribute_value')
            ->values();

        $rawScores = SawCriteriaScore::query()
            ->where('criterion_code', $selectedCriterion)
            ->get()
            ->groupBy('attribute_value')
            ->map(fn ($group) => $group->keyBy('method_code'));

        $matrix = [];
        foreach ($attributeValues as $attr) {
            foreach ($methods as $method) {
                $matrix[$attr][$method] = (int) ($rawScores[$attr][$method]->score ?? 0);
            }
        }

        return view('admin.saw_scores.index', [
            'criteria' => $criteria,
            'methods' => $methods,
            'selectedCriterion' => $selectedCriterion,
            'attributeValues' => $attributeValues,
            'matrix' => $matrix,
        ]);
    }

    public function update(Request $request)
    {
        $criteria = ['C1', 'C2', 'C3', 'C4'];
        $methods = ['M1', 'M2', 'M3', 'M4', 'M5'];

        $selectedCriterion = $request->string('criterion')->toString();
        if (!in_array($selectedCriterion, $criteria, true)) {
            abort(404);
        }

        $scores = $request->input('scores', []);
        if (!is_array($scores)) {
            return back()->with('success', 'Tidak ada perubahan.');
        }

        foreach ($scores as $attributeValue => $row) {
            if (!is_array($row)) {
                continue;
            }

            $attributeValue = trim((string) $attributeValue);
            if ($attributeValue === '') {
                continue;
            }

            foreach ($methods as $method) {
                if (!array_key_exists($method, $row)) {
                    continue;
                }

                $value = (int) $row[$method];
                if ($value < 0) {
                    $value = 0;
                }
                if ($value > 5) {
                    $value = 5;
                }

                SawCriteriaScore::updateOrCreate(
                    [
                        'criterion_code' => $selectedCriterion,
                        'attribute_value' => $attributeValue,
                        'method_code' => $method,
                    ],
                    ['score' => $value]
                );
            }
        }

        return redirect()
            ->route('admin.saw-scores.index', ['criterion' => $selectedCriterion])
            ->with('success', 'Sub-kriteria SAW berhasil diperbarui.');
    }
}

