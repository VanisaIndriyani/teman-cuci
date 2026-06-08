<?php

namespace Database\Seeders;

use App\Models\DetergentRecommendation;
use Illuminate\Database\Seeder;

class DetergentSeeder extends Seeder
{
    public function run(): void
    {
        DetergentRecommendation::truncate();

        $detergents = [
            // Katun
            ['method_code' => 'M3', 'fabric' => 'Katun', 'detergent_name' => 'Deterjen Bubuk/Cair Standar', 'detergent_type' => 'Umum', 'description' => 'Aman untuk serat katun yang kuat. Gunakan varian color-care untuk katun berwarna.'],
            ['method_code' => 'M1', 'fabric' => 'Katun', 'detergent_name' => 'Deterjen Cair Lembut', 'detergent_type' => 'Cair', 'description' => 'Mencegah serat katun menjadi kaku pada pencucian tangan.'],
            
            // Batik
            ['method_code' => 'M1', 'fabric' => 'Katun', 'detergent_name' => 'Lerak atau Sabun Batik Khusus', 'detergent_type' => 'Alami/Khusus', 'description' => 'Wajib untuk batik tulis/cap guna mempertahankan zat warna alami.'],
            
            // Denim
            ['method_code' => 'M3', 'fabric' => 'Denim', 'detergent_name' => 'Deterjen Cair Dark-Care', 'detergent_type' => 'Cair', 'description' => 'Membantu mengunci warna indigo denim agar tidak cepat pudar.'],
            
            // Rayon/Linen
            ['method_code' => 'M1', 'fabric' => 'Rayon', 'detergent_name' => 'Deterjen Cair pH Netral', 'detergent_type' => 'Cair', 'description' => 'Sangat lembut untuk serat semi-sintetis yang rapuh saat basah.'],
            ['method_code' => 'M4', 'fabric' => 'Linen', 'detergent_name' => 'Deterjen Delicate', 'detergent_type' => 'Cair', 'description' => 'Menjaga kelembutan serat linen pada putaran mesin halus.'],
            
            // Poliester
            ['method_code' => 'M3', 'fabric' => 'Poliester', 'detergent_name' => 'Deterjen Cair Matic', 'detergent_type' => 'Cair', 'description' => 'Efisien mengangkat noda minyak pada serat sintetis poliester.'],
        ];

        foreach ($detergents as $det) {
            DetergentRecommendation::create($det);
        }
    }
}
