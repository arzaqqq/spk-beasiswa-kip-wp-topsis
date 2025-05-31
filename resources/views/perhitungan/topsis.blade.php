@extends('layouts.app')
@section('title', 'Perhitungan TOPSIS')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Perhitungan Metode TOPSIS</h2>

    {{-- 1. Matriks Penilaian Asli --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">1. Matriks Penilaian</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriterias as $k)
                        <th>{{ $k->kode }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $a)
                    <tr>
                        <td>{{ $a->kode }}</td>
                        @foreach($kriterias as $k)
                            <td>{{ $matriks[$a->id][$k->id] }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 2. Pembagi (Normalizer) --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">2. Pembagi (Penyebut untuk Normalisasi)</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    @foreach($kriterias as $k)
                        <th>{{ $k->kode }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach($kriterias as $k)
                        <td>{{ number_format($pembagi[$k->id], 4) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    {{-- 3. Matriks Ternormalisasi Terbobot --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">3. Matriks Normalisasi × Bobot</h3>
        <table class="table table-bordered w-full text-sm">
            <thead class="bg-gray-200">
                <tr>
                    <th>Alternatif</th>
                    @foreach($kriterias as $k)
                        <th>{{ $k->kode }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $a)
                    <tr>
                        <td>{{ $a->kode }}</td>
                        @foreach($kriterias as $k)
                            <td>{{ number_format($terbobot[$a->id][$k->id], 6) }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 4. Solusi Ideal --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">4. Solusi Ideal</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Tipe</th>
                    @foreach($kriterias as $k)
                        <th>{{ $k->kode }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Ideal Positif (+)</td>
                    @foreach($kriterias as $k)
                        <td>{{ number_format($idealPositif[$k->id], 6) }}</td>
                    @endforeach
                </tr>
                <tr>
                    <td>Ideal Negatif (-)</td>
                    @foreach($kriterias as $k)
                        <td>{{ number_format($idealNegatif[$k->id], 6) }}</td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>

    {{-- 5. Jarak ke Ideal --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">5. Jarak ke Solusi Ideal</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Alternatif</th>
                    <th>Jarak + (d<sup>+</sup>)</th>
                    <th>Jarak – (d<sup>-</sup>)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $a)
                    <tr>
                        <td>{{ $a->kode }}</td>
                        <td>{{ number_format($dPlus[$a->id], 6) }}</td>
                        <td>{{ number_format($dMinus[$a->id], 6) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 6. Nilai Preferensi dan Ranking --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">6. Nilai Preferensi dan Ranking</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Peringkat</th>
                    <th>Alternatif</th>
                    <th>Nilai Preferensi (V)</th>
                </tr>
            </thead>
            <tbody>
                @php $rank = 1; @endphp
                @foreach($nilaiV as $id => $v)
                    <tr>
                        <td>{{ $rank++ }}</td>
                        <td>{{ $alternatifs->firstWhere('id', $id)->kode }}</td>
                        <td>{{ number_format($v, 6) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
