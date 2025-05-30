@extends('layouts.app')

@section('title', 'Alternatif')
@section('breadcrumb-active', 'Alternatif')
@section('current-page', 'Alternatif')

@push('styles')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="card">
        <div class="flex justify-between w-full px-6 mt-4">
        <div>
            <a href="{{ route('alternatif.create') }}" class="btn btn-primary">+ Tambah Alternatif</a>
        </div>
        <div>
            <form action="{{ route('alternatif.destroyall') }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus semua data?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus semua data</button>
            </form>
        </div>
        </div>

    <div class="card-body">
      <table id="alternatiftable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama</th>
                    <th>Nomor Induk</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($alternatifs as $a)
                    <tr>
                        <td>{{ $a->kode }}</td>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->nomor_induk }}</td>
                        <td>
                             <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="{{ route('alternatif.edit', $a->id) }}">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('alternatif.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus alternatif ini?')">
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
    const table = $("#alternatiftable").DataTable({
      responsive: true,
      lengthChange: false,
      autoWidth: false,
      buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"]
    });

    table.buttons().container().appendTo('#alternatiftable_wrapper .col-md-6:eq(0)');
  });
</script>
@endpush
