<?php

namespace Database\Seeders;

use App\Models\SawCriteriaScore;
use Illuminate\Database\Seeder;

class SawCriteriaScoreSeeder extends Seeder
{
    public function run(): void
    {
        $methods = ['M1', 'M2', 'M3', 'M4', 'M5'];
        $scores = [];

        // C1 - Jenis Kain (Cost/Benefit: In documentation listed values)
        // Values: Katun:5, Denim:4, Linen:3, Poliester:4, Rayon:1
        $fabrics = [
            'Katun' => [5, 5, 5, 5, 5],
            'Denim' => [4, 4, 4, 4, 4],
            'Linen' => [3, 3, 3, 3, 3],
            'Poliester' => [4, 4, 4, 4, 4],
            'Rayon' => [1, 1, 1, 1, 1]
        ];
        foreach ($fabrics as $val => $vals) {
            foreach ($methods as $i => $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C1', 'attribute_value' => $val, 'score' => $vals[$i]];
            }
        }

        // C2 - Motif
        // Values: Polos:5, Batik:1, Bordir/sablon:2
        $motifs = [
            'Polos' => [5, 5, 5, 5, 5],
            'Batik' => [1, 1, 1, 1, 1],
            'Sablon/Bordir' => [2, 2, 2, 2, 2]
        ];
        foreach ($motifs as $val => $vals) {
            foreach ($methods as $i => $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C2', 'attribute_value' => $val, 'score' => $vals[$i]];
            }
        }

        // C3 - Tingkat Kekotoran
        // Values: Ringan:2, Sedang:3, Berat:5
        $dirts = [
            'Ringan' => [2, 2, 2, 2, 2],
            'Sedang' => [3, 3, 3, 3, 3],
            'Berat' => [5, 5, 5, 5, 5]
        ];
        foreach ($dirts as $val => $vals) {
            foreach ($methods as $i => $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C3', 'attribute_value' => $val, 'score' => $vals[$i]];
            }
        }

        // C4 - Warna
        // Values: Putih:5, Gelap:2, Terang/Cerah:3
        $colors = [
            'Putih' => [5, 5, 5, 5, 5],
            'Gelap' => [2, 2, 2, 2, 2],
            'Terang/Cerah' => [3, 3, 3, 3, 3]
        ];
        foreach ($colors as $val => $vals) {
            foreach ($methods as $i => $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C4', 'attribute_value' => $val, 'score' => $vals[$i]];
            }
        }

        foreach ($scores as $score) {
            SawCriteriaScore::create($score);
        }
    }
}
