@extends('layouts.app')

@section('breadcrumb-active', 'Dashboard')
@section('current-page', 'Dashboard')

@section('content')
<div class="py-6">
    <!-- Header Dashboard -->
    <div class=" bg-green-600 text-white rounded-lg shadow-md p-6 mb-6">
        <h1 class="text-2xl font-bold">Sistem Pendukung Keputusan</h1>
        <h2 class="text-xl">Seleksi Penerima Beasiswa KIP</h2>
        <p class="mt-2">Universitas Malikussaleh</p>
    </div>

    <!-- Statistik Cepat -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-gray-500 font-medium">Total Kriteria</h3>
                    <p class="text-2xl font-bold">{{ $totalKriteria }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-gray-500 font-medium">Total Alternatif</h3>
                    <p class="text-2xl font-bold">{{ $totalAlternatif }}</p>
                </div>
                {{-- <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-gray-500 font-medium">Diterima</h3>
                    <p class="text-2xl font-bold">{{ $diterima }}</p>
                </div>
                <div class="bg-white rounded-lg shadow p-4">
                    <h3 class="text-gray-500 font-medium">Ditolak</h3>
                    <p class="text-2xl font-bold">{{ $ditolak }}</p> --}}
                </div>
            </div>

    <!-- Tabel Kriteria -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tabel Kriteria Acuan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama kriteria</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C1</td>
                        <td class="px-6 py-4 whitespace-nowrap">Pekerjaan Ayah</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C2</td>
                        <td class="px-6 py-4 whitespace-nowrap">Pekerjaan Ibu</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C3</td>
                        <td class="px-6 py-4 whitespace-nowrap">Penghasilan Orangtua</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C4</td>
                        <td class="px-6 py-4 whitespace-nowrap">Tanggungan Orangtua</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C5</td>
                        <td class="px-6 py-4 whitespace-nowrap">Kepemilikan Rumah</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C6</td>
                        <td class="px-6 py-4 whitespace-nowrap">Tingkat Prestasi</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C7</td>
                        <td class="px-6 py-4 whitespace-nowrap">Jumlah Prestasi</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Tabel Kriteria Kecocokan -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Tabel Kriteria Kecocokan</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kode</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bobot</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C1</td>
                        <td class="px-6 py-4 whitespace-nowrap">Cost</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.15</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C2</td>
                        <td class="px-6 py-4 whitespace-nowrap">Cost</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.15</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C3</td>
                        <td class="px-6 py-4 whitespace-nowrap">Cost</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.25</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C4</td>
                        <td class="px-6 py-4 whitespace-nowrap">Benefit</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.10</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C5</td>
                        <td class="px-6 py-4 whitespace-nowrap">Benefit</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.15</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C6</td>
                        <td class="px-6 py-4 whitespace-nowrap">Benefit</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.10</td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">C7</td>
                        <td class="px-6 py-4 whitespace-nowrap">Benefit</td>
                        <td class="px-6 py-4 whitespace-nowrap">0.10</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Detail Kriteria -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Pekerjaan Ayah -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Pekerjaan Ayah (C1)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak Kerja</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Nelayan / petani</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Swasta / wiraswasta</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Lainnya</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Kosong/tidak diisi</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Pekerjaan Ibu -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Pekerjaan Ibu (C2)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak Kerja</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Nelayan / petani</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Swasta / wiraswasta</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Lainnya</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Kosong/ tidak diisi</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Penghasilan Orangtua -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Penghasilan Orang Tua (C3)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">0 - Rp 1.000.000</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Rp 1.000.000 - Rp 2.000.000</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Rp 2.000.000 - Rp 3.000.000</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Rp 3.000.000 - > Rp 4.000.000</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak diisi</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tanggungan Orangtua -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Tanggungan Orang Tua (C4)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">>4 orang</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">4 orang</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">3 orang</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">2 orang</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">1 orang</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Status Tempat Tinggal -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Status Tempat Tinggal (C5)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak punya</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Menumpang</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Sewa tahunan/bulan</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Milik sendiri</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Kosong/tidak diisi</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tingkat Prestasi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel Jumlah Prestasi non-akademik (C6)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">3></td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak ada</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Jumlah Prestasi -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-bold mb-3 text-gray-800">Tabel tingkat juara Prestasi terbaik(C7)</h3>
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ketentuan Kriteria</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nilai</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Internasional</td>
                        <td class="px-4 py-2 whitespace-nowrap">5</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Nasional</td>
                        <td class="px-4 py-2 whitespace-nowrap">4</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Provinsi</td>
                        <td class="px-4 py-2 whitespace-nowrap">3</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Kab/kota</td>
                        <td class="px-4 py-2 whitespace-nowrap">2</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-2 whitespace-nowrap">Tidak ada</td>
                        <td class="px-4 py-2 whitespace-nowrap">1</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Diagram Sistem -->
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">Blok Diagram Sistem</h2>
        <div class="bg-gray-100 p-4 rounded-lg">
            <div class="text-center text-gray-600">
                [Diagram Sistem Pendukung Keputusan Penerima Beasiswa KIP]
            </div>
            <p class="mt-4 text-gray-700">
                Sistem ini dirancang untuk membantu proses seleksi penerima Beasiswa KIP dengan menggunakan 7 kriteria yang telah ditentukan.
                Setiap kriteria memiliki bobot dan aturan penilaian yang berbeda sesuai dengan prioritas dan kebutuhan seleksi.
            </p>
        </div>
    </div>
</div>
@endsection
