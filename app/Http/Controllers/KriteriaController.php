<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriterias = Kriteria::orderBy('kode')->get();
        $totalBobot = Kriteria::sum('bobot');

        return view('kriteria.index', compact('kriterias', 'totalBobot'));
    }

    public function create()
    {
        return view('kriteria.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriterias|max:10',
            'nama' => 'required|max:100',
            'jenis' => 'required|in:cost,benefit',
            'bobot' => 'required|numeric|min:0.001|max:1.000',
            'deskripsi' => 'nullable'
        ]);

        try {
            $kriteria = Kriteria::create($request->all());
            return redirect()->route('kriteria.index')
                ->with('success', 'Kriteria berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan kriteria: '.$e->getMessage());
        }
    }

    public function edit(Kriteria $kriteria)
    {
        return view('kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, Kriteria $kriteria)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kriterias,kode,'.$kriteria->id,
            'nama' => 'required|max:100',
            'jenis' => 'required|in:cost,benefit',
            'bobot' => 'required|numeric|min:0.001|max:1.000',
            'deskripsi' => 'nullable'
        ]);

        try {
            $kriteria->update($request->all());
            return redirect()->route('kriteria.index')
                ->with('success', 'Kriteria berhasil diperbarui');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui kriteria: '.$e->getMessage());
        }
    }

    public function destroy(Kriteria $kriteria)
    {
        try {
            $kriteria->delete();
            return redirect()->route('kriteria.index')
                ->with('success', 'Kriteria berhasil dihapus');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'Gagal menghapus kriteria: '.$e->getMessage());
        }
    }
}
