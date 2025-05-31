@extends('layouts.app')
@section('title', 'Tambah Penilaian')

@section('content')
<div class="card max-w-2xl mx-auto mt-5">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Penilaian</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('penilaian.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="alternatif_id">Pilih Alternatif</label>
                <select name="alternatif_id" id="alternatif_id" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    @foreach($alternatifs as $alt)
                        <option value="{{ $alt->id }}">{{ $alt->nama }} ({{ $alt->kode }})</option>
                    @endforeach
                </select>
            </div>

            @foreach ($kriterias as $k)
                <div class="mb-3">
                    <label for="nilai_{{ $k->id }}">{{ $k->nama }} ({{ $k->kode }})</label>
                    <select name="nilai[{{ $k->id }}]" class="form-control" required>
                        <option value="">-- Pilih Nilai --</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                </div>
            @endforeach

            <div class="flex justify-end">
                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
