<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'about_us', 'value' => 'TemanCuci adalah aplikasi Sistem Pendukung Keputusan yang membantu Anda merawat pakaian dengan cara yang benar.'],
            ['key' => 'guide', 'value' => 'Pilih karakteristik pakaian Anda pada form konsultasi, lalu sistem akan menganalisis metode terbaik.'],
            ['key' => 'video_url', 'value' => 'https://www.youtube.com/watch?v=Kz6EAn0X29c'],
            ['key' => 'footer_text', 'value' => '© 2026 TemanCuci - Solusi Cerdas Perawatan Pakaian.'],
        ];

        foreach ($settings as $setting) {
            \App\Models\AppSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
