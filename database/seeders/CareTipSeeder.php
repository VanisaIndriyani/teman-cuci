<?php

namespace Database\Seeders;

use App\Models\CareTip;
use Illuminate\Database\Seeder;

class CareTipSeeder extends Seeder
{
    public function run(): void
    {
        CareTip::truncate();

        $tips = [
            // Katun
            ['method_code' => 'M3', 'fabric_filter' => 'Katun', 'tip_text' => 'Dapat dijemur di bawah sinar matahari langsung untuk warna putih. Untuk warna, jemur terbalik.', 'sort_order' => 1],
            ['method_code' => 'M3', 'fabric_filter' => 'Katun', 'tip_text' => 'Aman disetrika dengan suhu tinggi (hingga 200°C) menggunakan uap.', 'sort_order' => 2],
            
            // Batik
            ['method_code' => 'M1', 'motif_filter' => 'Batik', 'tip_text' => 'Gunakan lerak atau deterjen khusus batik untuk menjaga keawetan warna alami.', 'sort_order' => 1],
            ['method_code' => 'M1', 'motif_filter' => 'Batik', 'tip_text' => 'Jemur di tempat teduh (diangin-anginkan), hindari sinar matahari langsung agar warna tidak pudar.', 'sort_order' => 2],
            
            // Denim
            ['method_code' => 'M3', 'fabric_filter' => 'Denim', 'tip_text' => 'Balik celana denim sebelum dicuci untuk mencegah gesekan drum mesin pada bagian luar.', 'sort_order' => 1],
            ['method_code' => 'M3', 'fabric_filter' => 'Denim', 'tip_text' => 'Gunakan air dingin untuk mempertahankan bentuk dan warna indigo denim.', 'sort_order' => 2],
            
            // Rayon
            ['method_code' => 'M1', 'fabric_filter' => 'Rayon', 'tip_text' => 'Jangan pernah memeras rayon dengan cara diputar. Tekan lembut dengan handuk kering.', 'sort_order' => 1],
            ['method_code' => 'M1', 'fabric_filter' => 'Rayon', 'tip_text' => 'Hamparkan datar saat menjemur untuk mencegah serat melar akibat berat air.', 'sort_order' => 2],
            
            // Sablon/Bordir
            ['method_code' => 'M1', 'motif_filter' => 'Sablon/Bordir', 'tip_text' => 'Jangan menyetrika langsung di atas area sablon. Gunakan kain pelapis atau setrika dari sisi dalam.', 'sort_order' => 1],
        ];

        foreach ($tips as $tip) {
            CareTip::create($tip);
        }
    }
}
