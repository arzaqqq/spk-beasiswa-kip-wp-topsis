<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
    {
        $data = [
            ['kode' => 'C1', 'nama' => 'Pekerjaan Ayah', 'jenis' => 'cost', 'bobot' => 0.15],
            ['kode' => 'C2', 'nama' => 'Pekerjaan Ibu', 'jenis' => 'cost', 'bobot' => 0.15],
            ['kode' => 'C3', 'nama' => 'Penghasilan Orangtua', 'jenis' => 'cost', 'bobot' => 0.25],
            ['kode' => 'C4', 'nama' => 'Tanggungan Orangtua', 'jenis' => 'benefit', 'bobot' => 0.10],
            ['kode' => 'C5', 'nama' => 'Kepemilikan Rumah', 'jenis' => 'benefit', 'bobot' => 0.15],
            ['kode' => 'C6', 'nama' => 'Tingkat Prestasi', 'jenis' => 'benefit', 'bobot' => 0.10],
            ['kode' => 'C7', 'nama' => 'Jumlah Prestasi', 'jenis' => 'benefit', 'bobot' => 0.10],
        ];

        foreach ($data as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
