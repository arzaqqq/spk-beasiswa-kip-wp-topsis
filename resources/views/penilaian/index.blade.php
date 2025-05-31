@extends('layouts.app')
@section('title', 'Penilaian')
@section('breadcrumb-active', 'Penilaian')

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('penilaian.create') }}" class="btn btn-primary">+ Tambah Penilaian</a>
    </div>
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
                        <td>{{ $a->nama }}</td>
                        @foreach ($kriterias as $k)
                            <td>
                                {{ optional($a->penilaians->where('kriteria_id', $k->id)->first())->nilai ?? '-' }}
                            </td>
                        @endforeach
                        <td>
                            <a href="{{ route('penilaian.edit', $a->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('penilaian.destroy', $a->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Hapus semua penilaian?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
