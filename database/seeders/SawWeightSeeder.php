<?php

namespace Database\Seeders;

use App\Models\SawWeight;
use Illuminate\Database\Seeder;

class SawWeightSeeder extends Seeder
{
    public function run(): void
    {
        $weights = [
            ['criterion_code' => 'C1', 'criterion_name' => 'Jenis Kain', 'weight' => 0.30, 'type' => 'benefit'],
            ['criterion_code' => 'C2', 'criterion_name' => 'Motif', 'weight' => 0.25, 'type' => 'benefit'],
            ['criterion_code' => 'C3', 'criterion_name' => 'Tingkat Kekotoran', 'weight' => 0.25, 'type' => 'benefit'],
            ['criterion_code' => 'C4', 'criterion_name' => 'Warna', 'weight' => 0.20, 'type' => 'benefit'],
        ];

        foreach ($weights as $weight) {
            SawWeight::updateOrCreate(
                ['criterion_code' => $weight['criterion_code']],
                $weight
            );
        }
    }
}
