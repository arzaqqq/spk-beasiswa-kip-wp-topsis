<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    public function run(): void
    {
        $nilaiData = [
            // kode_alternatif => [C1, C2, C3, C4, C5, C6, C7]
            'A1' => [3, 5, 4, 2, 2, 2, 3],
            'A2' => [4, 4, 5, 3, 2, 1, 1],
            'A3' => [4, 2, 1, 2, 1, 2, 3],
            'A4' => [5, 2, 5, 4, 2, 2, 3],
            'A5' => [5, 3, 5, 3, 2, 1, 1],
            'A6' => [4, 5, 5, 3, 2, 4, 5],
            'A7' => [4, 5, 5, 5, 2, 3, 3],
            'A8' => [3, 3, 3, 5, 2, 3, 4],
            'A9' => [2, 2, 1, 3, 1, 1, 1],
            'A10' => [2, 5, 1, 2, 1, 2, 4],
        ];

        $kriterias = Kriteria::orderBy('kode')->get(); // urut C1 - C7

        foreach ($nilaiData as $kodeAlt => $nilaiList) {
            $alternatif = Alternatif::where('kode', $kodeAlt)->first();

            if (!$alternatif) continue;

            foreach ($kriterias as $index => $kriteria) {
                Penilaian::updateOrCreate(
                    [
                        'alternatif_id' => $alternatif->id,
                        'kriteria_id' => $kriteria->id
                    ],
                    [
                        'nilai' => $nilaiList[$index]
                    ]
                );
            }
        }
    }
}
