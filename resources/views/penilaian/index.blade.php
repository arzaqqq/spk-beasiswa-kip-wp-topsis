@extends('layouts.app')
@section('title', 'Penilaian')
@section('breadcrumb-active', 'Penilaian')

@section('content')
<div class="card">
    {{-- <div class="card-header">
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">+ Tambah Penilaian</a>
    </div> --}}
    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Alternatif</th>
                    @foreach ($kriterias as $k)
                        <th>{{ $k->kode }}</th>
                    @endforeach
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($alternatifs as $a)
                    <tr>
                        <td>{{ $a->kode }}</td>
                        @foreach ($kriterias as $k)
                            <td>
                                {{ optional($a->penilaians->where('kriteria_id', $k->id)->first())->nilai ?? '-' }}
                            </td>
                        @endforeach
                        <td>
                            {{-- <a href="{{ route('penilaian.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('penilaian.destroy', $a->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus semua penilaian?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form> --}}

                             <div class="dropdown">
                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu{{ $a->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu{{ $a->id }}">
                                    <a class="dropdown-item" href="{{ route('penilaian.edit', $a->id) }}">
                                        <i class="fas fa-edit"></i> Penilaian
                                    </a>
                                    <form action="{{ route('penilaian.destroy', $a->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
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
