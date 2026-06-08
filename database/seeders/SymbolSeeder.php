<?php

namespace Database\Seeders;

use App\Models\CareSymbol;
use App\Models\SymbolCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SymbolSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Pencucian
        $washing = SymbolCategory::create([
            'name' => 'Pencucian (Washing)',
            'slug' => 'pencucian',
            'description' => 'Simbol terkait metode pencucian air.',
            'sort_order' => 1
        ]);

        CareSymbol::create([
            'category_id' => $washing->id,
            'iso_code' => 'W01',
            'name' => 'Cuci Tangan Saja',
            'image_path' => '/Data Simbol/Cuci tangan saja.png',
            'description_short' => 'Hanya cuci dengan tangan.',
            'description_long' => 'Jangan gunakan mesin cuci. Cuci lembut dengan tangan pada suhu maksimal 40°C.',
            'sort_order' => 1
        ]);

        CareSymbol::create([
            'category_id' => $washing->id,
            'iso_code' => 'W02',
            'name' => 'Jangan Dicuci',
            'image_path' => '/Data Simbol/Jangan dicuci.png',
            'description_short' => 'Pakaian tidak boleh dicuci air.',
            'description_long' => 'Pakaian ini sangat sensitif terhadap air dan deterjen rumah tangga.',
            'sort_order' => 2
        ]);

        // 2. Pemutihan
        $bleaching = SymbolCategory::create([
            'name' => 'Pemutihan (Bleaching)',
            'slug' => 'pemutihan',
            'description' => 'Simbol penggunaan bahan pemutih.',
            'sort_order' => 2
        ]);

        CareSymbol::create([
            'category_id' => $bleaching->id,
            'iso_code' => 'B01',
            'name' => 'Boleh Diputihkan',
            'image_path' => '/Data Simbol/Boleh diputihkan.png',
            'description_short' => 'Semua jenis pemutih diizinkan.',
            'description_long' => 'Pakaian dapat menggunakan pemutih klorin maupun non-klorin.',
            'sort_order' => 1
        ]);

        CareSymbol::create([
            'category_id' => $bleaching->id,
            'iso_code' => 'B02',
            'name' => 'Jangan Diputihkan',
            'image_path' => '/Data Simbol/Jangan diputihkan.png',
            'description_short' => 'Jangan gunakan pemutih.',
            'description_long' => 'Hindari segala jenis produk pemutih agar serat kain tidak rusak.',
            'sort_order' => 2
        ]);

        // 3. Penyetrikaan
        $ironing = SymbolCategory::create([
            'name' => 'Penyetrikaan (Ironing)',
            'slug' => 'penyetrikaan',
            'description' => 'Simbol terkait suhu dan teknik menyetrika.',
            'sort_order' => 3
        ]);

        CareSymbol::create([
            'category_id' => $ironing->id,
            'iso_code' => 'I01',
            'name' => 'Setrika dengan Kain Pelapis',
            'image_path' => '/Data Simbol/Setrika dengan kain pelapis.png',
            'description_short' => 'Gunakan kain pelapis saat menyetrika.',
            'description_long' => 'Jangan tempelkan setrika langsung ke kain. Gunakan kain tipis di antaranya.',
            'sort_order' => 1
        ]);

        CareSymbol::create([
            'category_id' => $ironing->id,
            'iso_code' => 'I02',
            'name' => 'Jangan Disetrika',
            'image_path' => '/Data Simbol/Jangan disetrika.png',
            'description_short' => 'Kain tidak tahan panas setrika.',
            'description_long' => 'Menyetrika kain ini dapat menyebabkan serat meleleh atau mengkilap permanen.',
            'sort_order' => 2
        ]);

        // 4. Dry Cleaning
        $dryclean = SymbolCategory::create([
            'name' => 'Dry Cleaning',
            'slug' => 'dry-cleaning',
            'description' => 'Simbol pencucian profesional tanpa air.',
            'sort_order' => 4
        ]);

        CareSymbol::create([
            'category_id' => $dryclean->id,
            'iso_code' => 'D01',
            'name' => 'Dry Cleaning - Semua Pelarut',
            'image_path' => '/Data Simbol/Dry cleaning – semua pelarut.png',
            'description_short' => 'Pencucian kering profesional.',
            'description_long' => 'Pakaian aman dibersihkan oleh layanan dry cleaning profesional.',
            'sort_order' => 1
        ]);
    }
}
