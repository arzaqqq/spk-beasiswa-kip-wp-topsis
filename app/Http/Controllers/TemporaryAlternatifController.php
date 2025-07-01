<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\DynamicTemporaryImport;

class TemporaryAlternatifController extends Controller
{
    public function index()
    {
        return view('temporary.upload');
    }

    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        $import = new DynamicTemporaryImport;
        Excel::import($import, $request->file('excel_file'));

        $data = $import->data;

        if (count($data) === 0) {
            return back()->with('error', 'Data kosong');
        }

        $headers = array_keys($data[0]);

        session(['excel_data' => $data, 'excel_headers' => $headers]);

        return redirect()->route('temporary.preview');
    }

    public function preview()
    {
        if (!session()->has('excel_data') || !session()->has('excel_headers')) {
            return redirect()->route('temporary.index')->with('error', 'Tidak ada data yang diunggah.');
        }

        return view('temporary.preview');
    }

    public function storeSelected(Request $request)
    {
        $request->validate([
            'fields' => 'required|array|min:1'
        ]);

        $fields = $request->input('fields');
        $data = session('excel_data');

        foreach ($data as $row) {
            $newData = [];

            foreach ($fields as $field) {
                $newData[$field] = $row[$field] ?? null;
            }

            // Pastikan kolom yang dipilih sesuai dengan field di table `alternatifs`
            Alternatif::create($newData);
        }

        // Hapus session setelah selesai
        session()->forget(['excel_data', 'excel_headers']);

        return redirect()->route('alternatif.index')->with('success', 'Data berhasil dipindahkan ke tabel Alternatif.');
    }
}
