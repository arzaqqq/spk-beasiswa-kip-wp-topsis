<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class PerhitunganController extends Controller
{
   public function wp()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        // Step 1: Ambil bobot dan total bobot
        $totalBobot = $kriterias->sum('bobot');
        $normalizedWeights = $kriterias->mapWithKeys(function ($kriteria) use ($totalBobot) {
            return [$kriteria->id => $kriteria->bobot / $totalBobot];
        });

        // Step 2: Hitung S untuk tiap alternatif
        $nilaiS = [];

        foreach ($alternatifs as $alt) {
            $product = 1;

            foreach ($kriterias as $kriteria) {
                $nilai = $penilaians->where('alternatif_id', $alt->id)->where('kriteria_id', $kriteria->id)->first()->nilai ?? 1;
                $bobot = $normalizedWeights[$kriteria->id];

                // Benefit = pangkat positif, Cost = pangkat negatif
                $pangkat = $kriteria->tipe === 'cost' ? -$bobot : $bobot;
                $product *= pow($nilai, $pangkat);
            }

            $nilaiS[$alt->id] = $product;
        }

        // Step 3: Hitung V = S / total S
        $totalS = array_sum($nilaiS);
        $nilaiV = [];
        foreach ($nilaiS as $id => $s) {
            $nilaiV[$id] = $s / $totalS;
        }

        // Step 4: Ranking
        arsort($nilaiV);
        $ranking = array_keys($nilaiV);

        return view('perhitungan.wp', compact('alternatifs', 'kriterias', 'nilaiS', 'nilaiV', 'normalizedWeights', 'ranking'));
    }
}
