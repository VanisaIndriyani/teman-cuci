<?php

namespace Database\Seeders;

use App\Models\WashingStep;
use Illuminate\Database\Seeder;

class WashingStepSeeder extends Seeder
{
    public function run(): void
    {
        WashingStep::truncate();

        $steps = [
            // M1 — Cuci Tangan dengan Air Dingin (≤30°C)
            ['method_code' => 'M1', 'step_order' => 1, 'title' => 'Persiapkan Tempat Cuci', 'description' => 'Siapkan baskom, ember, atau wastafel bersih berukuran cukup besar agar pakaian dapat bergerak bebas.', 'tip' => 'Pastikan tempat cuci bebas dari sisa deterjen lain.'],
            ['method_code' => 'M1', 'step_order' => 2, 'title' => 'Isi Air Dingin', 'description' => 'Isi tempat cuci dengan air dingin atau air suhu ruangan (≤30°C).', 'tip' => 'Jangan gunakan air hangat untuk kain sensitif.'],
            ['method_code' => 'M1', 'step_order' => 3, 'title' => 'Larutkan Deterjen', 'description' => 'Tuang deterjen cair khusus kain halus (pH netral 6–8) secukupnya ke dalam air.', 'tip' => 'Jangan tuang deterjen langsung ke pakaian.'],
            ['method_code' => 'M1', 'step_order' => 4, 'title' => 'Rendam (Jika Diperlukan)', 'description' => 'Masukkan pakaian ke dalam larutan deterjen. Tekan perlahan agar air meresap.', 'tip' => 'Jangan rendam lebih dari 15 menit untuk batik/rayon.'],
            ['method_code' => 'M1', 'step_order' => 5, 'title' => 'Cuci dengan Teknik Tekan & Peras Lembut', 'description' => 'Angkat dan tekan pakaian berulang kali di dalam air — jangan menggosok kain.', 'tip' => 'Gunakan sikat kecil lembut untuk noda membandel.'],
            ['method_code' => 'M1', 'step_order' => 6, 'title' => 'Bilas Pertama', 'description' => 'Buang air sabun. Isi kembali dengan air dingin bersih dan bilas 2-3 kali.', 'tip' => 'Tambahkan cuka putih pada bilas terakhir untuk menjaga warna.'],
            ['method_code' => 'M1', 'step_order' => 7, 'title' => 'Peras dengan Lembut', 'description' => 'Lipat pakaian dan tekan ke dinding baskom untuk mengeluarkan air.', 'tip' => 'Jangan memeras dengan memutar (wringing).'],
            ['method_code' => 'M1', 'step_order' => 8, 'title' => 'Pengeringan Awal', 'description' => 'Angkat pakaian dengan dukungan penuh dan segera gantung atau hamparkan.', 'tip' => 'Jangan ditarik dari satu titik saja agar tidak melar.'],

            // M2 — Cuci Tangan dengan Air Hangat (30–40°C)
            ['method_code' => 'M2', 'step_order' => 1, 'title' => 'Persiapkan Tempat Cuci', 'description' => 'Siapkan baskom atau wastafel bersih yang cukup untuk ruang gerak pakaian.', 'tip' => 'Pastikan tidak ada kontaminan dari cucian sebelumnya.'],
            ['method_code' => 'M2', 'step_order' => 2, 'title' => 'Isi Air Hangat (30–40°C)', 'description' => 'Gunakan air hangat yang nyaman (suam-suam kuku), jangan terlalu panas.', 'tip' => 'Suhu di atas 40°C dapat menyebabkan penyusutan.'],
            ['method_code' => 'M2', 'step_order' => 3, 'title' => 'Larutkan Deterjen', 'description' => 'Gunakan deterjen cair atau bubuk formulasi suhu sedang dan aduk hingga larut.', 'tip' => 'Untuk putih, boleh gunakan deterjen dengan oxygen bleach.'],
            ['method_code' => 'M2', 'step_order' => 4, 'title' => 'Rendam 15–20 Menit', 'description' => 'Masukkan pakaian dan pastikan terendam sepenuhnya.', 'tip' => 'Air hangat membantu melonggarkan kotoran lebih efektif.'],
            ['method_code' => 'M2', 'step_order' => 5, 'title' => 'Cuci dengan Teknik Gosok Lembut', 'description' => 'Gosok area kotor dengan gerakan melingkar menggunakan tangan atau sikat lembut.', 'tip' => 'Fokuskan pada area lipatan seperti kerah dan ketiak.'],
            ['method_code' => 'M2', 'step_order' => 6, 'title' => 'Bilas Bersih (2–3 Kali)', 'description' => 'Bilas dengan air hangat pertama, lalu air dingin pada bilas terakhir.', 'tip' => 'Bilas hingga air benar-benar jernih.'],
            ['method_code' => 'M2', 'step_order' => 7, 'title' => 'Peras Secukupnya', 'description' => 'Peras dengan teknik menekan. Kain tebal boleh diperas lebih kuat.', 'tip' => 'Jangan memutar kain saat memeras.'],
            ['method_code' => 'M2', 'step_order' => 8, 'title' => 'Siapkan untuk Pengeringan', 'description' => 'Bentuk pakaian kembali ke asalnya (rapikan kerah dan jahitan).', 'tip' => 'Jangan biarkan menumpuk basah terlalu lama.'],

            // M3 — Mesin Cuci Mode Normal
            ['method_code' => 'M3', 'step_order' => 1, 'title' => 'Sortir Pakaian', 'description' => 'Pisahkan berdasarkan warna, berat kain, dan tingkat kekotoran.', 'tip' => 'Jangan campurkan pakaian baru berwarna pada cuci pertama.'],
            ['method_code' => 'M3', 'step_order' => 2, 'title' => 'Periksa Kantong & Tutup Ritsleting', 'description' => 'Keluarkan isi kantong dan tutup semua ritsleting.', 'tip' => 'Balik pakaian denim dan bersablon ke arah dalam.'],
            ['method_code' => 'M3', 'step_order' => 3, 'title' => 'Masukkan Pakaian ke Mesin', 'description' => 'Isi drum maksimal ¾ kapasitas agar air dan deterjen bersirkulasi.', 'tip' => 'Jangan terlalu padat untuk hasil maksimal.'],
            ['method_code' => 'M3', 'step_order' => 4, 'title' => 'Tambahkan Deterjen', 'description' => 'Masukkan deterjen ke laci kompartemen sesuai takaran kemasan.', 'tip' => 'Jangan berlebih agar tidak meninggalkan residu.'],
            ['method_code' => 'M3', 'step_order' => 5, 'title' => 'Pilih Program & Suhu', 'description' => 'Pilih program Cotton/Normal dengan suhu 30-40°C.', 'tip' => 'Gunakan 60°C hanya untuk katun putih sangat kotor.'],
            ['method_code' => 'M3', 'step_order' => 6, 'title' => 'Jalankan Siklus Cuci', 'description' => 'Tunggu hingga siklus selesai penuh termasuk bilas dan pemerasan.', 'tip' => 'Hentikan jika mesin bergetar tidak seimbang.'],
            ['method_code' => 'M3', 'step_order' => 7, 'title' => 'Segera Keluarkan Setelah Selesai', 'description' => 'Segera keluarkan pakaian untuk menghindari bau apek dan kerutan.', 'tip' => 'Kocok lembut pakaian sebelum digantung.'],
            ['method_code' => 'M3', 'step_order' => 8, 'title' => 'Bersihkan Mesin Secara Berkala', 'description' => 'Bersihkan filter serat dan jalankan siklus pembersihan drum bulanan.', 'tip' => 'Gunakan cuka untuk membersihkan drum.'],

            // M4 — Mesin Cuci Mode Halus / Delicate
            ['method_code' => 'M4', 'step_order' => 1, 'title' => 'Sortir & Periksa Label Pakaian', 'description' => 'Pastikan label pakaian mengizinkan pencucian mesin (bukan simbol X).', 'tip' => 'Kelompokkan kain rajutan, linen halus, dan batik modern.'],
            ['method_code' => 'M4', 'step_order' => 2, 'title' => 'Masukkan ke Laundry Bag', 'description' => 'Gunakan kantong jaring (laundry bag) untuk perlindungan ekstra.', 'tip' => 'Wajib untuk bordir, manik-manik, dan rajutan.'],
            ['method_code' => 'M4', 'step_order' => 3, 'title' => 'Isi Mesin Tidak Lebih dari Setengah Kapasitas', 'description' => 'Mode delicate butuh ruang air lebih banyak untuk agitasi lembut.', 'tip' => 'Isi drum hanya ½ kapasitas.'],
            ['method_code' => 'M4', 'step_order' => 4, 'title' => 'Gunakan Deterjen Khusus Delicate', 'description' => 'Pilih deterjen cair pH netral tanpa enzim agresif.', 'tip' => 'Gunakan ½ dari takaran normal.'],
            ['method_code' => 'M4', 'step_order' => 5, 'title' => 'Pilih Program Delicate/Gentle', 'description' => 'Pilih program Delicate/Wool dengan putaran rendah (400–600 rpm).', 'tip' => 'Gunakan suhu dingin atau maksimal 30°C.'],
            ['method_code' => 'M4', 'step_order' => 6, 'title' => 'Tambahkan Cuka Putih (Opsional)', 'description' => 'Masukkan cuka putih ke kompartemen softener sebagai pelembut alami.', 'tip' => 'Membantu menjaga warna dan menghilangkan residu.'],
            ['method_code' => 'M4', 'step_order' => 7, 'title' => 'Keluarkan Segera Setelah Siklus Selesai', 'description' => 'Keluarkan segera agar kain tidak kusut permanen.', 'tip' => 'Keluarkan dari laundry bag dan bentuk ulang.'],
            ['method_code' => 'M4', 'step_order' => 8, 'title' => 'Periksa Hasil & Bentuk Ulang', 'description' => 'Bentuk kembali pakaian rajutan saat masih basah.', 'tip' => 'Serat rajutan mengikuti bentuk saat pengeringan.'],

            // M5 — Dry Cleaning (Pembersihan Profesional)
            ['method_code' => 'M5', 'step_order' => 1, 'title' => 'Periksa Label & Informasi Pakaian', 'description' => 'Catat simbol ISO (P, F, atau A dalam lingkaran) pada label.', 'tip' => 'Foto label untuk ditunjukkan ke petugas.'],
            ['method_code' => 'M5', 'step_order' => 2, 'title' => 'Identifikasi & Tandai Noda', 'description' => 'Tandai lokasi noda dan informasikan jenisnya ke petugas.', 'tip' => 'Jangan mencoba membersihkan noda sendiri.'],
            ['method_code' => 'M5', 'step_order' => 3, 'title' => 'Kosongkan Kantong & Lepas Aksesori', 'description' => 'Lepas bros, ikat pinggang, dan aksesori lepasan lainnya.', 'tip' => 'Beberapa pelarut dapat merusak aksesori tertentu.'],
            ['method_code' => 'M5', 'step_order' => 4, 'title' => 'Komunikasikan Kekhawatiran Khusus', 'description' => 'Beri tahu petugas jika kain sangat sensitif seperti batik tulis.', 'tip' => 'Tanyakan opsi wet cleaning jika tersedia.'],
            ['method_code' => 'M5', 'step_order' => 5, 'title' => 'Proses di Laundry (Profesional)', 'description' => 'Pakaian dibersihkan menggunakan pelarut khusus oleh profesional.', 'tip' => 'Suhu dan durasi dikontrol secara digital.'],
            ['method_code' => 'M5', 'step_order' => 6, 'title' => 'Pemeriksaan Saat Mengambil', 'description' => 'Pastikan noda terangkat dan kain tidak rusak sebelum pulang.', 'tip' => 'Buka plastik pembungkus segera di rumah.'],
            ['method_code' => 'M5', 'step_order' => 7, 'title' => 'Penyimpanan Setelah Dry Cleaning', 'description' => 'Anginkan pakaian selama 1-2 jam sebelum disimpan di lemari.', 'tip' => 'Gunakan hanger lebar untuk menjaga bentuk bahu.'],
        ];

        foreach ($steps as $step) {
            WashingStep::create($step);
        }
    }
}
