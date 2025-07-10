@extends('layouts.app')

@section('title', 'Kriteria')
@section('page-title', 'Kriteria')
@section('breadcrumb-active', 'Kriteria')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Kriteria</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="mb-3">
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kriteria
            </a>
            <span class="float-right">
                <strong>Total Bobot: {{ number_format($totalBobot, 3) }}</strong>
            </span>
        </div>
        <table id="kriteriaTable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Bobot</th>
                    <th>Deskripsi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kriterias as $kriteria)
                    <tr>
                        <td>{{ $kriteria->kode }}</td>
                        <td>{{ $kriteria->nama }}</td>
                        <td>{{ ucfirst($kriteria->jenis) }}</td>
                        <td>{{ number_format($kriteria->bobot, 3) }}</td>
                        <td>{{ $kriteria->deskripsi ?? '-' }}</td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu{{ $kriteria->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu{{ $kriteria->id }}">
                                    <a class="dropdown-item" href="{{ route('kriteria.edit', $kriteria->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="fas fa-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.card-body -->
</div>

    <!-- Modal peringatan total bobot -->
    @if ($totalBobot != 1.000)
    <div class="modal fade" id="bobotWarningModal" tabindex="-1" role="dialog" aria-labelledby="bobotWarningLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="bobotWarningLabel">Peringatan!</h5>
        </div>
        <div class="modal-body">
            <strong>Jumlah total bobot melebihi 1.000!</strong><br>
            Saat ini: <strong>{{ number_format($totalBobot, 3) }}</strong><br>
            Silakan sesuaikan kembali bobot kriteria Anda.
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-dark" data-dismiss="modal">Tutup</button>
        </div>
        </div>
    </div>
    </div>
    @endif


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
            const table = $("#kriteriaTable").DataTable({
                responsive: true,
                lengthChange: true,
                autoWidth: false,
                buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],

            });

            table.buttons().container().appendTo('#kriteriaTable_wrapper .col-md-6:eq(0)');
        });
    </script>

    @if ($totalBobot != 1.000)
<script>
    $(document).ready(function () {
        $('#bobotWarningModal').modal('show');
    });
</script>
@endif

@endpush
