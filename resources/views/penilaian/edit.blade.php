@extends('layouts.app')
@section('title', 'Edit Penilaian')

@section('content')
<div class="card max-w-2xl mx-auto mt-5">
    <div class="card-header">
        <h3 class="card-title">Edit Penilaian: {{ $alternatif->nama }} ({{ $alternatif->kode }})</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
            @csrf
            @method('PUT')

            <input type="hidden" name="alternatif_id" value="{{ $alternatif->id }}">

            @foreach ($kriterias as $k)
                <div class="mb-3">
                    <label for="nilai_{{ $k->id }}">{{ $k->nama }} ({{ $k->kode }})</label>
                    <select name="nilai[{{ $k->id }}]" class="form-control" required>
                        <option value="">-- Pilih Nilai --</option>
                        @for($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ (isset($penilaian[$k->id]) && $penilaian[$k->id] == $i) ? 'selected' : '' }}>
                                {{ $i }}
                            </option>
                        @endfor
                    </select>
                </div>
            @endforeach

            <div class="flex justify-end">
                <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ml-2">Update</button>
            </div>
        </form>
    </div>
</div>
@endsection
