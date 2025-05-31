<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PerhitunganController extends Controller
{
    public function wp()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        if ($alternatifs->isEmpty() || $kriterias->isEmpty()) {
            throw new \Exception('Alternatif atau Kriteria tidak ditemukan.');
        }

        // Validasi jenis kriteria
        foreach ($kriterias as $kriteria) {
            if (!in_array($kriteria->jenis, ['cost', 'benefit'])) {
                throw new \Exception("Jenis kriteria {$kriteria->kode} tidak valid: {$kriteria->jenis}");
            }
        }

        $totalBobot = $kriterias->sum('bobot');
        if ($totalBobot == 0) {
            throw new \Exception('Total bobot tidak boleh nol.');
        }
        $normalizedWeights = $kriterias->mapWithKeys(function ($kriteria) use ($totalBobot) {
            return [$kriteria->id => $kriteria->bobot / $totalBobot];
        });

        $nilaiS = [];
        foreach ($alternatifs as $alt) {
            $product = 1;
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->where('alternatif_id', $alt->id)
                                        ->where('kriteria_id', $kriteria->id)
                                        ->first();
                if (!$penilaian) {
                    throw new \Exception("Nilai untuk alternatif {$alt->id} dan kriteria {$kriteria->id} tidak ditemukan.");
                }
                $nilai = $penilaian->nilai;
                if ($nilai == 0) {
                    throw new \Exception("Nilai untuk alternatif {$alt->id} dan kriteria {$kriteria->id} tidak boleh nol.");
                }
                $bobot = $normalizedWeights[$kriteria->id];
                $pangkat = $kriteria->jenis === 'cost' ? -$bobot : $bobot; // Gunakan jenis
                $product *= pow($nilai, $pangkat);
            }
            $nilaiS[$alt->id] = $product;
        }

        $totalS = array_sum($nilaiS);
        if ($totalS == 0) {
            throw new \Exception('Total S tidak boleh nol.');
        }
        $nilaiV = [];
        foreach ($nilaiS as $id => $s) {
            $nilaiV[$id] = $s / $totalS;
        }

        arsort($nilaiV);
        $ranking = array_keys($nilaiV);

        Log::info('WP Results', [
            'nilaiS' => $nilaiS,
            'nilaiV' => $nilaiV,
            'ranking' => $ranking
        ]);

        return view('perhitungan.wp', compact('alternatifs', 'kriterias', 'nilaiS', 'nilaiV', 'normalizedWeights', 'ranking'));
    }

    public function topsis()
    {
        $alternatifs = Alternatif::with('penilaians')->get();
        $kriterias = Kriteria::all();

        if ($alternatifs->isEmpty() || $kriterias->isEmpty()) {
            throw new \Exception('Alternatif atau Kriteria tidak ditemukan.');
        }

        // Log semua jenis kriteria untuk debugging
        Log::info('Jenis Kriteria', $kriterias->mapWithKeys(function ($k) {
            return [$k->kode => $k->jenis];
        })->toArray());

        // Validasi jenis kriteria
        foreach ($kriterias as $kriteria) {
            if (!in_array($kriteria->jenis, ['cost', 'benefit'])) {
                throw new \Exception("Jenis kriteria {$kriteria->kode} tidak valid: {$kriteria->jenis}");
            }
        }

        $matriks = [];
        $pembagi = [];

        // Step 1: Build decision matrix and calculate dividers
        foreach ($kriterias as $k) {
            $sumKuadrat = 0;
            foreach ($alternatifs as $a) {
                $penilaian = $a->penilaians->where('kriteria_id', $k->id)->first();
                if (!$penilaian) {
                    throw new \Exception("Nilai untuk alternatif {$a->id} dan kriteria {$k->id} tidak ditemukan.");
                }
                $nilai = $penilaian->nilai;
                $matriks[$a->id][$k->id] = $nilai;
                $sumKuadrat += pow($nilai, 2);
            }
            $pembagi[$k->id] = sqrt($sumKuadrat);
            if ($pembagi[$k->id] == 0) {
                throw new \Exception("Pembagi untuk kriteria {$k->id} tidak boleh nol.");
            }
        }

        // Step 2: Normalize and apply weights
        $terbobot = [];
        foreach ($alternatifs as $a) {
            foreach ($kriterias as $k) {
                $normal = $matriks[$a->id][$k->id] / $pembagi[$k->id];
                $terbobot[$a->id][$k->id] = $normal * $k->bobot;
            }
        }

        // Step 3: Determine ideal positive and negative solutions
        $idealPositif = [];
        $idealNegatif = [];
        foreach ($kriterias as $k) {
            $kolom = array_column($terbobot, $k->id);
            $idealPositif[$k->id] = $k->jenis === 'benefit' ? max($kolom) : min($kolom); // Gunakan jenis
            $idealNegatif[$k->id] = $k->jenis === 'benefit' ? min($kolom) : max($kolom); // Gunakan jenis
        }

        // Step 4: Calculate distances
        $dPlus = [];
        $dMinus = [];
        foreach ($alternatifs as $a) {
            $plus = 0;
            $minus = 0;
            foreach ($kriterias as $k) {
                $val = $terbobot[$a->id][$k->id];
                $plus += pow($val - $idealPositif[$k->id], 2);
                $minus += pow($val - $idealNegatif[$k->id], 2);
            }
            $dPlus[$a->id] = sqrt($plus);
            $dMinus[$a->id] = sqrt($minus);
        }

        // Step 5: Calculate preference scores
        $nilaiV = [];
        foreach ($alternatifs as $a) {
            $sumDistances = $dPlus[$a->id] + $dMinus[$a->id];
            $nilaiV[$a->id] = $sumDistances == 0 ? 0 : $dMinus[$a->id] / $sumDistances;
        }

        arsort($nilaiV);
        $ranking = array_keys($nilaiV);

        Log::info('TOPSIS Results', [
            'matriks' => $matriks,
            'pembagi' => $pembagi,
            'terbobot' => $terbobot,
            'idealPositif' => $idealPositif,
            'idealNegatif' => $idealNegatif,
            'dPlus' => $dPlus,
            'dMinus' => $dMinus,
            'nilaiV' => $nilaiV,
            'ranking' => $ranking
        ]);

        return view('perhitungan.topsis', compact(
            'alternatifs', 'kriterias', 'matriks', 'pembagi',
            'terbobot', 'idealPositif', 'idealNegatif',
            'dPlus', 'dMinus', 'nilaiV', 'ranking'
        ));
    }

    public function rekomendasi()
    {
        $alternatifs = Alternatif::all();
        $kriterias = Kriteria::all();
        $penilaians = Penilaian::all();

        if ($alternatifs->isEmpty() || $kriterias->isEmpty()) {
            throw new \Exception('Alternatif atau Kriteria tidak ditemukan.');
        }

        // Validasi jenis kriteria
        foreach ($kriterias as $kriteria) {
            if (!in_array($kriteria->jenis, ['cost', 'benefit'])) {
                throw new \Exception("Jenis kriteria {$kriteria->kode} tidak valid: {$kriteria->jenis}");
            }
        }

        // Hitung WP
        $totalBobot = $kriterias->sum('bobot');
        if ($totalBobot == 0) {
            throw new \Exception('Total bobot tidak boleh nol.');
        }
        $normalizedWeights = $kriterias->mapWithKeys(function ($kriteria) use ($totalBobot) {
            return [$kriteria->id => $kriteria->bobot / $totalBobot];
        });

        $nilaiS = [];
        foreach ($alternatifs as $alt) {
            $product = 1;
            foreach ($kriterias as $kriteria) {
                $penilaian = $penilaians->where('alternatif_id', $alt->id)
                                        ->where('kriteria_id', $kriteria->id)
                                        ->first();
                if (!$penilaian) {
                    throw new \Exception("Nilai untuk alternatif {$alt->id} dan kriteria {$kriteria->id} tidak ditemukan.");
                }
                $nilai = $penilaian->nilai;
                if ($nilai == 0) {
                    throw new \Exception("Nilai untuk alternatif {$alt->id} dan kriteria {$kriteria->id} tidak boleh nol.");
                }
                $bobot = $normalizedWeights[$kriteria->id];
                $pangkat = $kriteria->jenis === 'cost' ? -$bobot : $bobot;
                $product *= pow($nilai, $pangkat);
            }
            $nilaiS[$alt->id] = $product;
        }

        $totalS = array_sum($nilaiS);
        if ($totalS == 0) {
            throw new \Exception('Total S tidak boleh nol.');
        }
        $nilaiV_wp = [];
        foreach ($nilaiS as $id => $s) {
            $nilaiV_wp[$id] = $s / $totalS;
        }

        // Hitung TOPSIS
        $matriks = [];
        $pembagi = [];
        foreach ($kriterias as $k) {
            $sumKuadrat = 0;
            foreach ($alternatifs as $a) {
                $penilaian = $penilaians->where('alternatif_id', $a->id)
                                        ->where('kriteria_id', $k->id)
                                        ->first();
                if (!$penilaian) {
                    throw new \Exception("Nilai untuk alternatif {$a->id} dan kriteria {$k->id} tidak ditemukan.");
                }
                $nilai = $penilaian->nilai;
                $matriks[$a->id][$k->id] = $nilai;
                $sumKuadrat += pow($nilai, 2);
            }
            $pembagi[$k->id] = sqrt($sumKuadrat);
            if ($pembagi[$k->id] == 0) {
                throw new \Exception("Pembagi untuk kriteria {$k->id} tidak boleh nol.");
            }
        }

        $terbobot = [];
        foreach ($alternatifs as $a) {
            foreach ($kriterias as $k) {
                $normal = $matriks[$a->id][$k->id] / $pembagi[$k->id];
                $terbobot[$a->id][$k->id] = $normal * $k->bobot;
            }
        }

        $idealPositif = [];
        $idealNegatif = [];
        foreach ($kriterias as $k) {
            $kolom = array_column($terbobot, $k->id);
            $idealPositif[$k->id] = $k->jenis === 'benefit' ? max($kolom) : min($kolom);
            $idealNegatif[$k->id] = $k->jenis === 'benefit' ? min($kolom) : max($kolom);
        }

        $dPlus = [];
        $dMinus = [];
        foreach ($alternatifs as $a) {
            $plus = 0;
            $minus = 0;
            foreach ($kriterias as $k) {
                $val = $terbobot[$a->id][$k->id];
                $plus += pow($val - $idealPositif[$k->id], 2);
                $minus += pow($val - $idealNegatif[$k->id], 2);
            }
            $dPlus[$a->id] = sqrt($plus);
            $dMinus[$a->id] = sqrt($minus);
        }

        $nilaiV_topsis = [];
        foreach ($alternatifs as $a) {
            $sumDistances = $dPlus[$a->id] + $dMinus[$a->id];
            $nilaiV_topsis[$a->id] = $sumDistances == 0 ? 0 : $dMinus[$a->id] / $sumDistances;
        }

        // Gabungkan hasil WP dan TOPSIS
        $rekomendasi = [];
        foreach ($alternatifs as $alt) {
            $wp_score = $nilaiV_wp[$alt->id] ?? 0;
            $topsis_score = $nilaiV_topsis[$alt->id] ?? 0;
            // Total: rata-rata WP dan TOPSIS (bisa disesuaikan, misalnya bobot 0.5:0.5)
            $total_score = ($wp_score + $topsis_score) / 2;

            $rekomendasi[] = [
                'kode' => $alt->kode,
                'nama' => $alt->nama,
                'nomor_induk' => $alt->nomor_induk,
                'wp_score' => $wp_score,
                'topsis_score' => $topsis_score,
                'total_score' => $total_score,
            ];
        }

        // Urutkan berdasarkan total_score (descending)
        usort($rekomendasi, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        // Tambahkan peringkat
        foreach ($rekomendasi as $index => &$item) {
            $item['peringkat'] = $index + 1;
        }

        Log::info('Rekomendasi Results', [
            'rekomendasi' => $rekomendasi,
        ]);

        return view('perhitungan.rekomendasi', compact('rekomendasi'));
    }
}
