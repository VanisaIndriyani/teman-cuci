<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::first();
        
        // Define Categories
        $catBasics = ArticleCategory::firstOrCreate(['name' => 'Panduan Dasar', 'slug' => 'panduan-dasar']);
        $catSpecial = ArticleCategory::firstOrCreate(['name' => 'Perawatan Khusus', 'slug' => 'perawatan-khusus']);
        $catTips = ArticleCategory::firstOrCreate(['name' => 'Tips & Trik', 'slug' => 'tips-trik']);

        $articles = [
            [
                'title' => 'Panduan Lengkap Mencuci Pakaian Berdasarkan Jenis Kain',
                'slug' => 'panduan-mencuci-berdasarkan-jenis-kain',
                'category_id' => $catBasics->id,
                'meta_title' => 'Cara Mencuci Pakaian Sesuai Jenis Kain – TemanCuci',
                'meta_desc' => 'Panduan lengkap mencuci katun, rayon, denim, linen, dan poliester. Cegah kerusakan kain dengan metode yang tepat.',
                'content' => "Setiap jenis kain memiliki karakteristik serat yang berbeda, sehingga memerlukan penanganan yang berbeda pula. Mencuci semua pakaian dengan cara yang sama adalah kesalahan umum yang dapat memperpendek umur pakaian secara signifikan.\n\nKATUN: Kain paling mudah dirawat. Dapat dicuci mesin mode normal dengan air hangat. Rentan menyusut pada suhu sangat tinggi, terutama pada pencucian pertama.\n\nRAYON: Semi-sintetis yang terasa lembut tetapi sangat rapuh saat basah. Selalu cuci tangan dengan air dingin. Peras sangat lembut, jangan memutar. Jemur dalam keadaan dihampar atau digantung dengan hanger lebar.\n\nDENIM: Kuat namun warnanya mudah luntur. Balik pakaian sebelum mencuci, gunakan air dingin, dan cuci jarang (setiap 3–5 pemakaian) untuk mempertahankan warna dan bentuk.\n\nLINEN: Elegan tapi mudah kusut. Untuk kekotoran ringan, cuci tangan cukup. Setrika selagi masih sedikit lembab untuk hasil terbaik. Hindari agitasi tinggi yang menyebabkan penyusutan.\n\nPOLIESTER: Sintetis yang tahan lama dan cepat kering. Air dingin atau hangat aman. Hindari suhu sangat panas. Tambahkan cuka putih pada bilasan terakhir untuk menghilangkan bau.",
                'status' => 'published',
            ],
            [
                'title' => 'Rahasia Merawat Batik Agar Warna Tetap Cerah dan Tahan Lama',
                'slug' => 'merawat-batik-warna-tahan-lama',
                'category_id' => $catSpecial->id,
                'meta_title' => 'Cara Merawat Batik yang Benar – TemanCuci',
                'meta_desc' => 'Pelajari cara mencuci batik tulis, batik cap, dan batik modern agar warnanya tetap cerah dan tidak cepat luntur.',
                'content' => "Batik adalah warisan budaya Indonesia yang memerlukan perhatian khusus. Pewarna yang digunakan — baik pewarna alami maupun sintetis — bersifat sensitif terhadap panas dan deterjen keras.\n\nCARA MENCUCI: Gunakan air dingin (<30°C) and deterjen lerak atau sabun khusus kain batik dengan pH netral. Rendam maksimal 10 menit, peras lembut tanpa menggosok. Jangan merendam terlalu lama karena menyebabkan warna memudar merata.\n\nPENGERINGAN: Jemur di tempat teduh, hindari sinar matahari langsung. Angin saja sudah cukup untuk mengeringkan batik. Jangan menggunakan dryer mesin.\n\nPENYETRIKAAN: Setrika dengan suhu rendah hingga sedang. Gunakan kain pelapis tipis di antara setrika dan batik. Setrika dari sisi dalam kain.\n\nPENYIMPANAN: Simpan dengan dilipat, bukan digantung. Lapisi dengan kertas tisu bebas asam untuk batik berharga tinggi. Simpan di tempat sejuk dan kering.\n\nKAPAN KE DRY CLEANING: Batik tulis antik, batik berbahan sutra, atau batik dengan pewarna alami sangat sensitif. Dry cleaning profesional adalah pilihan paling aman untuk koleksi berharga.",
                'status' => 'published',
            ],
            [
                'title' => '5 Kesalahan Saat Mencuci Pakaian yang Harus Dihindari',
                'slug' => 'kesalahan-umum-mencuci-pakaian',
                'category_id' => $catTips->id,
                'meta_title' => 'Kesalahan Mencuci Pakaian yang Sering Dilakukan – TemanCuci',
                'meta_desc' => 'Apakah kamu melakukan kesalahan ini saat mencuci? Pelajari 5 kebiasaan yang diam-diam merusak pakaian favoritmu.',
                'content' => "1. TERLALU BANYAK DETERJEN: Residu deterjen yang tersisa di kain menyebabkan iritasi kulit, membuat pakaian kaku, dan menumpulkan warna. Ikuti takaran kemasan atau gunakan lebih sedikit untuk pakaian tidak terlalu kotor.\n\n2. TIDAK MEMISAHKAN WARNA: Pakaian gelap, terang, dan putih harus dicuci terpisah. Pakaian berwarna baru wajib dicuci sendiri untuk mencegah luntur ke pakaian lain.\n\n3. MESIN TERLALU PENUH: Pakaian tidak dapat bergerak bebas, mengakibatkan pencucian tidak merata dan pakaian masih berbau. Isi maksimal 3/4 kapasitas mesin.\n\n4. MENGABAIKAN NODA SEGAR: Noda yang dibiarkan mengering jauh lebih sulit dihilangkan. Segera bilas noda segar dari sisi belakang kain dengan air dingin mengalir. Jangan digosok — tepuk lembut untuk menyerap cairan.\n\n5. MENGERINGKAN DI BAWAH TERIK MATAHARI: Sinar UV langsung memudarkan warna dan merusak serat. Jemur di tempat teduh dengan sirkulasi udara baik, terutama untuk kain batik, denim gelap, dan pakaian berwarna cerah.",
                'status' => 'published',
            ],
        ];

        foreach ($articles as $art) {
            $article = Article::updateOrCreate(
                ['slug' => $art['slug']],
                [
                    'author_id' => $admin?->id,
                    'title' => $art['title'],
                    'content' => $art['content'],
                    'meta_title' => $art['meta_title'],
                    'meta_desc' => $art['meta_desc'],
                    'status' => $art['status'],
                    'published_at' => now(),
                ]
            );
            $article->categories()->sync([$art['category_id']]);
        }
    }
}
