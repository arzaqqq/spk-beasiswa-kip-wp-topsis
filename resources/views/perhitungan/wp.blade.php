@extends('layouts.app')
@section('title', 'Perhitungan WP (Weighted Product)')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Perhitungan Metode WP</h2>

    {{-- 1. TABEL NORMALISASI BOBOT --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Normalisasi Bobot</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Bobot Asli</th>
                    <th>Tipe</th>
                    <th>Bobot Ternormalisasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kriterias as $kriteria)
                    <tr>
                        <td>{{ $kriteria->kode }}</td>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>{{ ucfirst($kriteria->tipe) }}</td>
                        <td>{{ number_format($normalizedWeights[$kriteria->id], 4) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 2. TABEL PENILAIAN PER ALTERNATIF --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Matriks Penilaian</h3>
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
                            <td>
                                {{
                                    optional(
                                        $a->penilaians->where('kriteria_id', $k->id)->first()
                                    )->nilai ?? '-'
                                }}
                            </td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 3. NILAI S --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Nilai S (Product WP)</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai S</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiS as $id => $s)
                    <tr>
                        <td>{{ $alternatifs->firstWhere('id', $id)->kode }}</td>
                        <td>{{ number_format($s, 6) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 4. NILAI V --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Nilai Preferensi (V)</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Alternatif</th>
                    <th>Nilai V</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiV as $id => $v)
                    <tr>
                        <td>{{ $alternatifs->firstWhere('id', $id)->kode }}</td>
                        <td>{{ number_format($v, 6) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- 5. RANKING --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Ranking</h3>
        <table class="table table-bordered w-full">
            <thead class="bg-gray-200">
                <tr>
                    <th>Peringkat</th>
                    <th>Alternatif</th>
                    <th>Nilai V</th>
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
