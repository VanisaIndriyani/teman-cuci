<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Apa itu TemanCuci?', 'answer' => 'TemanCuci adalah sistem pakar untuk rekomendasi pencucian pakaian.', 'sort_order' => 1, 'is_active' => true],
            ['question' => 'Bagaimana cara kerjanya?', 'answer' => 'Masukkan data pakaian Anda, sistem akan menghitung metode terbaik.', 'sort_order' => 2, 'is_active' => true],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
