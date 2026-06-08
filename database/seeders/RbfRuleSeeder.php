<?php

namespace Database\Seeders;

use App\Models\RbfRule;
use Illuminate\Database\Seeder;

class RbfRuleSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            ['rule_code' => 'R01', 'fabric' => 'Rayon', 'eliminated_method' => 'M2', 'reason' => 'Rayon sensitif terhadap air hangat', 'condition_desc' => 'Jenis Kain = Rayon'],
            ['rule_code' => 'R02', 'fabric' => 'Rayon', 'eliminated_method' => 'M3', 'reason' => 'Rayon mudah menyusut di mesin normal', 'condition_desc' => 'Jenis Kain = Rayon'],
            ['rule_code' => 'R03', 'fabric' => 'Rayon', 'eliminated_method' => 'M4', 'reason' => 'Rayon mudah rusak seratnya di mesin', 'condition_desc' => 'Jenis Kain = Rayon'],
            ['rule_code' => 'R04', 'fabric' => 'Linen', 'dirt_level' => 'Ringan', 'eliminated_method' => 'M3', 'reason' => 'Linen kotoran ringan cukup cuci lembut', 'condition_desc' => 'Jenis Kain = Linen AND Kekotoran = Ringan'],
            ['rule_code' => 'R05', 'fabric' => 'Linen', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M3', 'reason' => 'Mesin cuci normal merusak motif pada linen', 'condition_desc' => 'Jenis Kain = Linen AND Motif = Sablon/Bordir'],
            ['rule_code' => 'R06', 'fabric' => 'Denim', 'color' => 'Gelap', 'eliminated_method' => 'M2', 'reason' => 'Air hangat memudarkan warna denim gelap', 'condition_desc' => 'Jenis Kain = Denim AND Warna = Gelap'],
            ['rule_code' => 'R07', 'fabric' => 'Denim', 'color' => 'Gelap', 'eliminated_method' => 'M3', 'reason' => 'Mesin normal memudarkan warna denim gelap', 'condition_desc' => 'Jenis Kain = Denim AND Warna = Gelap'],
            ['rule_code' => 'R08', 'fabric' => 'Poliester', 'dirt_level' => 'Berat', 'eliminated_method' => 'M5', 'reason' => 'Dry clean tidak efektif untuk noda air berat di poliester', 'condition_desc' => 'Jenis Kain = Poliester AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R09', 'fabric' => 'Poliester', 'color' => 'Terang/Cerah', 'eliminated_method' => 'M2', 'reason' => 'Air hangat merusak kecerahan warna poliester', 'condition_desc' => 'Jenis Kain = Poliester AND Warna = Terang/Cerah'],
            ['rule_code' => 'R10', 'motif' => 'Batik', 'eliminated_method' => 'M2', 'reason' => 'Air hangat melunturkan malam/warna batik', 'condition_desc' => 'Motif = Batik'],
            ['rule_code' => 'R11', 'motif' => 'Batik', 'eliminated_method' => 'M3', 'reason' => 'Mesin normal merusak serat dan warna batik', 'condition_desc' => 'Motif = Batik'],
            ['rule_code' => 'R12', 'motif' => 'Batik', 'eliminated_method' => 'M4', 'reason' => 'Mesin halus masih berisiko untuk batik tulis/cap', 'condition_desc' => 'Motif = Batik'],
            ['rule_code' => 'R13', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M2', 'reason' => 'Air hangat merusak elastisitas sablon', 'condition_desc' => 'Motif = Sablon/Bordir'],
            ['rule_code' => 'R14', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M3', 'reason' => 'Mesin normal mengelupas sablon/merusak bordir', 'condition_desc' => 'Motif = Sablon/Bordir'],
            ['rule_code' => 'R15', 'dirt_level' => 'Berat', 'eliminated_method' => 'M1', 'reason' => 'Tangan air dingin kurang efektif untuk noda berat', 'condition_desc' => 'Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R16', 'dirt_level' => 'Berat', 'eliminated_method' => 'M5', 'reason' => 'Dry clean kurang efektif untuk noda berbasis air berat', 'condition_desc' => 'Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R17', 'dirt_level' => 'Ringan', 'fabric' => 'Katun', 'eliminated_method' => 'M5', 'reason' => 'Katun kotoran ringan tidak perlu dry clean', 'condition_desc' => 'Tingkat Kekotoran = Ringan AND Jenis Kain = Katun'],
            ['rule_code' => 'R18', 'dirt_level' => 'Ringan', 'fabric' => 'Poliester', 'eliminated_method' => 'M5', 'reason' => 'Poliester kotoran ringan tidak perlu dry clean', 'condition_desc' => 'Tingkat Kekotoran = Ringan AND Jenis Kain = Poliester'],
            ['rule_code' => 'R19', 'color' => 'Putih', 'fabric' => 'Katun', 'dirt_level' => 'Ringan', 'eliminated_method' => 'M5', 'reason' => 'Katun putih ringan lebih baik dicuci air', 'condition_desc' => 'Warna = Putih AND Jenis Kain = Katun AND Kekotoran = Ringan'],
            ['rule_code' => 'R20', 'motif' => 'Batik', 'dirt_level' => 'Sedang', 'eliminated_method' => 'M1', 'reason' => 'Batik kotoran sedang butuh penanganan lebih dari tangan dingin saja', 'condition_desc' => 'Motif = Batik AND Tingkat Kekotoran = Sedang'],
            ['rule_code' => 'R21', 'fabric' => 'Rayon', 'motif' => 'Batik', 'eliminated_method' => 'M2', 'reason' => 'Kombinasi rayon batik sangat sensitif air hangat', 'condition_desc' => 'Jenis Kain = Rayon AND Motif = Batik'],
            ['rule_code' => 'R22', 'fabric' => 'Rayon', 'motif' => 'Batik', 'eliminated_method' => 'M3', 'reason' => 'Kombinasi rayon batik mudah rusak di mesin normal', 'condition_desc' => 'Jenis Kain = Rayon AND Motif = Batik'],
            ['rule_code' => 'R23', 'fabric' => 'Rayon', 'motif' => 'Batik', 'eliminated_method' => 'M4', 'reason' => 'Kombinasi rayon batik berisiko di mesin halus', 'condition_desc' => 'Jenis Kain = Rayon AND Motif = Batik'],
            ['rule_code' => 'R24', 'fabric' => 'Denim', 'dirt_level' => 'Berat', 'eliminated_method' => 'M1', 'reason' => 'Denim kotoran berat sulit bersih dengan tangan dingin saja', 'condition_desc' => 'Jenis Kain = Denim AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R25', 'color' => 'Gelap', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M2', 'reason' => 'Air hangat melunturkan gelap dan merusak sablon', 'condition_desc' => 'Warna = Gelap AND Motif = Sablon/Bordir'],
            ['rule_code' => 'R26', 'color' => 'Terang/Cerah', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M2', 'reason' => 'Air hangat memudarkan cerah dan merusak sablon', 'condition_desc' => 'Warna = Terang/Cerah AND Motif = Sablon/Bordir'],
            ['rule_code' => 'R27', 'fabric' => 'Linen', 'color' => 'Gelap', 'eliminated_method' => 'M3', 'reason' => 'Mesin normal memudarkan warna linen gelap', 'condition_desc' => 'Jenis Kain = Linen AND Warna = Gelap'],
            ['rule_code' => 'R28', 'fabric' => 'Katun', 'motif' => 'Batik', 'color' => 'Gelap', 'eliminated_method' => 'M3', 'reason' => 'Batik katun gelap berisiko di mesin normal', 'condition_desc' => 'Jenis Kain = Katun AND Motif = Batik AND Warna = Gelap'],
            ['rule_code' => 'R29', 'fabric' => 'Katun', 'motif' => 'Batik', 'color' => 'Gelap', 'eliminated_method' => 'M2', 'reason' => 'Batik katun gelap berisiko di air hangat', 'condition_desc' => 'Jenis Kain = Katun AND Motif = Batik AND Warna = Gelap'],
            ['rule_code' => 'R30', 'fabric' => 'Poliester', 'motif' => 'Sablon/Bordir', 'eliminated_method' => 'M3', 'reason' => 'Mesin normal merusak sablon pada poliester', 'condition_desc' => 'Jenis Kain = Poliester AND Motif = Sablon/Bordir'],
            ['rule_code' => 'R31', 'fabric' => 'Linen', 'dirt_level' => 'Berat', 'eliminated_method' => 'M4', 'reason' => 'Linen kotoran berat butuh agitasi lebih dari mesin halus', 'condition_desc' => 'Jenis Kain = Linen AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R32', 'fabric' => 'Linen', 'dirt_level' => 'Berat', 'eliminated_method' => 'M1', 'reason' => 'Linen kotoran berat sulit bersih dengan tangan dingin', 'condition_desc' => 'Jenis Kain = Linen AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R33', 'motif' => 'Batik', 'color' => 'Terang/Cerah', 'eliminated_method' => 'M3', 'reason' => 'Batik cerah cepat pudar di mesin normal', 'condition_desc' => 'Motif = Batik AND Warna = Terang/Cerah'],
            ['rule_code' => 'R34', 'motif' => 'Batik', 'color' => 'Terang/Cerah', 'eliminated_method' => 'M2', 'reason' => 'Batik cerah cepat luntur di air hangat', 'condition_desc' => 'Motif = Batik AND Warna = Terang/Cerah'],
            ['rule_code' => 'R35', 'fabric' => 'Denim', 'dirt_level' => 'Ringan', 'eliminated_method' => 'M5', 'reason' => 'Denim tidak disarankan dry clean', 'condition_desc' => 'Jenis Kain = Denim AND Kekotoran = Ringan'],
            ['rule_code' => 'R36', 'color' => 'Putih', 'motif' => 'Sablon/Bordir', 'dirt_level' => 'Berat', 'eliminated_method' => 'M5', 'reason' => 'Sablon kotoran berat tidak cocok dry clean', 'condition_desc' => 'Warna = Putih AND Motif = Sablon/Bordir AND Kekotoran = Berat'],
            ['rule_code' => 'R37', 'fabric' => 'Rayon', 'dirt_level' => 'Berat', 'eliminated_method' => 'M3', 'reason' => 'Rayon kotoran berat tetap tidak boleh mesin normal', 'condition_desc' => 'Jenis Kain = Rayon AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R38', 'fabric' => 'Rayon', 'dirt_level' => 'Berat', 'eliminated_method' => 'M2', 'reason' => 'Rayon kotoran berat tetap tidak boleh air hangat', 'condition_desc' => 'Jenis Kain = Rayon AND Tingkat Kekotoran = Berat'],
            ['rule_code' => 'R39', 'color' => 'Gelap', 'dirt_level' => 'Ringan', 'eliminated_method' => 'M3', 'reason' => 'Warna gelap ringan cukup cuci lembut', 'condition_desc' => 'Warna = Gelap AND Tingkat Kekotoran = Ringan'],
            ['rule_code' => 'R40', 'motif' => 'Polos', 'fabric' => 'Katun', 'color' => 'Putih', 'dirt_level' => 'Berat', 'eliminated_method' => 'M5', 'reason' => 'Katun putih polos berat lebih baik dicuci air', 'condition_desc' => 'Motif = Polos AND Jenis Kain = Katun AND Warna = Putih AND Kekotoran = Berat'],
        ];

        foreach ($rules as $rule) {
            RbfRule::create($rule);
        }
    }
}
