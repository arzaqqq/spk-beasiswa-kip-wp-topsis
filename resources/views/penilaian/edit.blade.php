@extends('layouts.app')
@section('title', 'Edit Penilaian')

@section('content')
<div class="container max-w-4xl mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg">
    <div class="mb-6">
        <h3 class="text-2xl font-bold text-gray-800">Edit Penilaian: {{ $alternatif->nama }} ({{ $alternatif->kode }})</h3>
        <p class="text-gray-600 mt-2">Silakan pilih nilai untuk setiap kriteria berdasarkan ketentuan yang ditampilkan di bawah.</p>
    </div>

    <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')

        <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">

        @foreach ($kriterias as $k)
            <div class="mb-6 p-4 bg-gray-50 rounded-lg shadow-sm">
                <!-- Label Kriteria -->
                <label for="nilai_{{ $k->id }}" class="block text-lg font-medium text-gray-700 mb-2">
                    {{ $k->nama }} ({{ $k->kode }})
                </label>

                <!-- Dropdown Nilai -->
                <div class="flex flex-col md:flex-row md:items-start md:space-x-6">
                    <div class="w-full md:w-1/3">
                        <select name="nilai[{{ $k->id }}]" id="nilai_{{ $k->id }}" class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                            <option value="">-- Pilih Nilai --</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ (isset($penilaian[$k->id]) && $penilaian[$k->id] == $i) ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                        @error("nilai.{$k->id}")
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Keterangan Kriteria -->
                    <div class="mt-4 md:mt-0 w-full md:w-2/3">
                        <div class="bg-white p-4 rounded-lg border border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700 mb-2">Keterangan Nilai ({{ $k->kode }}):</h4>
                            <ul class="text-sm text-gray-600 space-y-1">
                                @if($k->kode == 'C1') <!-- Pekerjaan Ayah -->
                                    <li><span class="font-medium">5:</span> Tidak Kerja</li>
                                    <li><span class="font-medium">4:</span> Nelayan / Petani</li>
                                    <li><span class="font-medium">3:</span> Swasta / Wiraswasta</li>
                                    <li><span class="font-medium">2:</span> Lainnya</li>
                                    <li><span class="font-medium">1:</span> Kosong / Tidak Diisi</li>
                                @elseif($k->kode == 'C2') <!-- Pekerjaan Ibu -->
                                    <li><span class="font-medium">5:</span> Tidak Kerja</li>
                                    <li><span class="font-medium">4:</span> Nelayan / Petani</li>
                                    <li><span class="font-medium">3:</span> Swasta / Wiraswasta</li>
                                    <li><span class="font-medium">2:</span> Lainnya</li>
                                    <li><span class="font-medium">1:</span> Kosong / Tidak Diisi</li>
                                @elseif($k->kode == 'C3') <!-- Penghasilan Orang Tua -->
                                    <li><span class="font-medium">5:</span> 0 - Rp 1.000.000</li>
                                    <li><span class="font-medium">4:</span> Rp 1.000.000 - Rp 2.000.000</li>
                                    <li><span class="font-medium">3:</span> Rp 2.000.000 - Rp 3.000.000</li>
                                    <li><span class="font-medium">2:</span> Rp 3.000.000 - > Rp 4.000.000</li>
                                    <li><span class="font-medium">1:</span> Tidak Diisi</li>
                                @elseif($k->kode == 'C4') <!-- Tanggungan Orang Tua -->
                                    <li><span class="font-medium">5:</span> > 4 Orang</li>
                                    <li><span class="font-medium">4:</span> 4 Orang</li>
                                    <li><span class="font-medium">3:</span> 3 Orang</li>
                                    <li><span class="font-medium">2:</span> 2 Orang</li>
                                    <li><span class="font-medium">1:</span> 1 Orang</li>
                                @elseif($k->kode == 'C5') <!-- Status Tempat Tinggal -->
                                    <li><span class="font-medium">5:</span> Tidak Punya</li>
                                    <li><span class="font-medium">4:</span> Menumpang</li>
                                    <li><span class="font-medium">3:</span> Sewa Tahunan / Bulan</li>
                                    <li><span class="font-medium">2:</span> Milik Sendiri</li>
                                    <li><span class="font-medium">1:</span> Kosong / Tidak Diisi</li>
                                @elseif($k->kode == 'C6') <!-- Jumlah Prestasi Non-Akademik -->
                                    <li><span class="font-medium">5:</span> > 3</li>
                                    <li><span class="font-medium">4:</span> 2</li>
                                    <li><span class="font-medium">3:</span> 1</li>
                                    <li><span class="font-medium">1:</span> Tidak Ada</li>
                                @elseif($k->kode == 'C7') <!-- Tingkat Juara Prestasi Terbaik -->
                                    <li><span class="font-medium">5:</span> Internasional</li>
                                    <li><span class="font-medium">4:</span> Nasional</li>
                                    <li><span class="font-medium">3:</span> Provinsi</li>
                                    <li><span class="font-medium">2:</span> Kabupaten / Kota</li>
                                    <li><span class="font-medium">1:</span> Tidak Ada</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        <!-- Tombol Aksi -->
        <div class="flex justify-end space-x-3 mt-6">
            <button class=" bg-red-600 hover:bg-red-700 rounded-lg text-white mr-3">
                 <a href="{{ route('penilaian.index') }}" class="btn bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md">
                    Batal
                </a>
            </button>
            {{-- <a href="{{ route('penilaian.index') }}" class=" bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg  transition">Batal</a> --}}
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">Update</button>

        </div>
    </form>
</div>
@endsection
