@extends('layouts.app')

@section('title', 'Rekomendasi')
@section('current-page', 'Rekomendasi')
@section('breadcrumb-active', 'Rekomendasi')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="container">
    <h1 class="my-4">Hasil Rekomendasi Beasiswa</h1>
    <div class="card">
        <div class="card-body">
            <table id="Table" class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Peringkat</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Nomor Induk</th>
                        <th>Nilai WP</th>
                        <th>Nilai TOPSIS</th>
                        <th>Total Skor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rekomendasi as $item)
                    <tr>
                        <td>{{ $item['peringkat'] }}</td>
                        <td>{{ $item['kode'] }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ $item['nomor_induk'] }}</td>
                        <td>{{ number_format($item['wp_score'], 6) }}</td>
                        <td>{{ number_format($item['topsis_score'], 6) }}</td>
                        <td>{{ number_format($item['total_score'], 6) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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


    <script>
        $(function () {
            const table = $("#Table").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

            });

            table.buttons().container().appendTo('#Table_wrapper .col-md-6:eq(0)');
        });
    </script>
@endpush
