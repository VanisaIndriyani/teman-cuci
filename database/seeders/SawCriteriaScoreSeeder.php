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

        SawCriteriaScore::query()->delete();

        // C1 - Jenis Kain
        $fabrics = [
            'Katun' => ['M1' => 3, 'M2' => 4, 'M3' => 5, 'M4' => 4, 'M5' => 2],
            'Rayon' => ['M1' => 5, 'M2' => 4, 'M3' => 1, 'M4' => 3, 'M5' => 2],
            'Denim' => ['M1' => 3, 'M2' => 2, 'M3' => 4, 'M4' => 5, 'M5' => 1],
            'Linen' => ['M1' => 5, 'M2' => 3, 'M3' => 1, 'M4' => 4, 'M5' => 2],
            'Poliester' => ['M1' => 2, 'M2' => 3, 'M3' => 5, 'M4' => 4, 'M5' => 1],
        ];
        foreach ($fabrics as $val => $map) {
            foreach ($methods as $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C1', 'attribute_value' => $val, 'score' => $map[$m]];
            }
        }

        // C2 - Motif
        $motifs = [
            'Polos' => ['M1' => 3, 'M2' => 4, 'M3' => 5, 'M4' => 4, 'M5' => 2],
            'Batik' => ['M1' => 5, 'M2' => 3, 'M3' => 1, 'M4' => 2, 'M5' => 4],
            'Sablon/Bordir' => ['M1' => 5, 'M2' => 4, 'M3' => 1, 'M4' => 3, 'M5' => 2],
        ];
        foreach ($motifs as $val => $map) {
            foreach ($methods as $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C2', 'attribute_value' => $val, 'score' => $map[$m]];
            }
        }

        // C3 - Tingkat Kekotoran
        $dirts = [
            'Ringan' => ['M1' => 5, 'M2' => 3, 'M3' => 2, 'M4' => 4, 'M5' => 1],
            'Sedang' => ['M1' => 3, 'M2' => 4, 'M3' => 5, 'M4' => 3, 'M5' => 2],
            'Berat' => ['M1' => 1, 'M2' => 4, 'M3' => 5, 'M4' => 2, 'M5' => 3],
        ];
        foreach ($dirts as $val => $map) {
            foreach ($methods as $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C3', 'attribute_value' => $val, 'score' => $map[$m]];
            }
        }

        // C4 - Warna
        $colors = [
            'Putih' => ['M1' => 3, 'M2' => 4, 'M3' => 5, 'M4' => 3, 'M5' => 2],
            'Gelap' => ['M1' => 5, 'M2' => 1, 'M3' => 3, 'M4' => 4, 'M5' => 2],
            'Terang/Cerah' => ['M1' => 5, 'M2' => 3, 'M3' => 2, 'M4' => 4, 'M5' => 1],
        ];
        foreach ($colors as $val => $map) {
            foreach ($methods as $m) {
                $scores[] = ['method_code' => $m, 'criterion_code' => 'C4', 'attribute_value' => $val, 'score' => $map[$m]];
            }
        }

        foreach ($scores as $score) {
            SawCriteriaScore::create($score);
        }
    }
}
