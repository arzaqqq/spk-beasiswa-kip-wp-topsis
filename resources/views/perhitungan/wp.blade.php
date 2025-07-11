@extends('layouts.app')
@section('title', 'Perhitungan WP (Weighted Product)')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-6">Perhitungan Metode WP</h2>

    {{-- 1. TABEL NORMALISASI BOBOT --}}
    <div class="mb-8">
        <h3 class="text-xl font-semibold mb-2">Normalisasi Bobot</h3>
        <table class="table table-bordered w-full">
            <thead>
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
                        <td>{{ ucfirst($kriteria->jenis) }}</td>
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
            <thead>
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
            <thead>
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
            <thead>
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
            <thead>
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


@push('scripts')
   <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

@endpush
