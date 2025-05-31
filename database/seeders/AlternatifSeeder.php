<?php

namespace Database\Seeders;

use App\Models\Alternatif;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kode' => 'A1', 'nama' => 'Ahmad', 'nomor_induk' => 260210222],
            ['kode' => 'A2', 'nama' => 'Budi', 'nomor_induk' => 260210223],
            ['kode' => 'A3', 'nama' => 'Citra', 'nomor_induk' => 260210224],
            ['kode' => 'A4', 'nama' => 'Dewi', 'nomor_induk' => 260210225],
            ['kode' => 'A5', 'nama' => 'Eko', 'nomor_induk' => 260210226],
            ['kode' => 'A6', 'nama' => 'Fani', 'nomor_induk' => 260210227],
            ['kode' => 'A7', 'nama' => 'Gita', 'nomor_induk' => 260210228],
            ['kode' => 'A8', 'nama' => 'Hadi', 'nomor_induk' => 260210229],
            ['kode' => 'A9', 'nama' => 'Indah', 'nomor_induk' => 260210230],
            ['kode' => 'A10', 'nama' => 'Joko', 'nomor_induk' => 260210231],
        ];

        foreach ($data as $alternatif) {
            Alternatif::create($alternatif);
        }
    }
}
