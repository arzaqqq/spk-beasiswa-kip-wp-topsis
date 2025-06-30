<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AlternatifController extends Controller
{
    public function index()
    {
        $alternatifs = Alternatif::orderBy('kode')->get();
        return view('alternatif.index', compact('alternatifs'));
    }

   public function create()
{
    $last = Alternatif::orderBy('id', 'desc')->first();
    $nextNumber = $last ? intval(substr($last->kode, 1)) + 1 : 1;
    $nextKode = 'A' . $nextNumber;

    return view('alternatif.create', compact('nextKode'));
}


   public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nomor_induk' => 'required|numeric',
        ]);

        // Generate kode otomatis A1, A2, dst.
        $last = Alternatif::orderBy('id', 'desc')->first();
        $nextNumber = $last ? ((int) filter_var($last->kode, FILTER_SANITIZE_NUMBER_INT)) + 1 : 1;
        $kode = 'A' . $nextNumber;

        try {
            Alternatif::create([
                'kode' => $kode,
                'nama' => $request->nama,
                'nomor_induk' => $request->nomor_induk,
            ]);
            return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal menambahkan alternatif: ' . $e->getMessage());
        }
    }


    public function edit(Alternatif $alternatif)
    {
        return view('alternatif.edit', compact('alternatif'));
    }

    public function update(Request $request, Alternatif $alternatif)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'nomor_induk' => 'required|numeric',
        ]);

        try {
            $alternatif->update([
                'nama' => $request->nama,
                'nomor_induk' => $request->nomor_induk,
            ]);
            return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'Gagal memperbarui alternatif: ' . $e->getMessage());
        }
    }


    public function destroy(Alternatif $alternatif)
    {
        try {
            $alternatif->delete();
            return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus alternatif: ' . $e->getMessage());
        }
    }

    public function destroyall()
    {
        // Alternatif::truncate();
        DB::table('alternatifs')->delete(); // bukan truncate

        return redirect()->route('alternatif.index')->with('success', 'Semua data alternatif berhasil dihapus.');
    }

}
