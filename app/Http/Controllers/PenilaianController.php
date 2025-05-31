<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Penilaian;
use App\Models\Alternatif;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::with('penilaians.kriteria')->get();
        $kriterias = Kriteria::orderBy('kode')->get();

        return view('penilaian.index', compact('alternatifs', 'kriterias'));
    }

    public function create()
    {
        $alternatifs = Alternatif::orderBy('kode')->get();
        $kriterias = Kriteria::orderBy('kode')->get();
        return view('penilaian.create', compact('alternatifs', 'kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alternatif_id' => 'required|exists:alternatifs,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:5'
        ]);

        foreach ($request->nilai as $kriteria_id => $nilai) {
            Penilaian::updateOrCreate([
                'alternatif_id' => $request->alternatif_id,
                'kriteria_id' => $kriteria_id,
            ], [
                'nilai' => $nilai
            ]);
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil disimpan.');
    }

    public function edit(Alternatif $alternatif)
    {
        $kriterias = Kriteria::orderBy('kode')->get();
        $penilaian = $alternatif->penilaians->pluck('nilai', 'kriteria_id')->toArray();

        return view('penilaian.edit', compact('alternatif', 'kriterias', 'penilaian'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nilai' => 'required|array',
            'nilai.*' => 'required|integer|min:1|max:5'
        ]);

        foreach ($request->nilai as $kriteria_id => $nilai) {
            Penilaian::updateOrCreate([
                'alternatif_id' => $alternatif->id,
                'kriteria_id' => $kriteria_id,
            ], [
                'nilai' => $nilai
            ]);
        }

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diperbarui.');
    }

    public function destroy(Alternatif $alternatif)
    {
        $alternatif->penilaians()->delete();
        return redirect()->route('penilaian.index')->with('success', 'Semua penilaian alternatif dihapus.');
    }
}
