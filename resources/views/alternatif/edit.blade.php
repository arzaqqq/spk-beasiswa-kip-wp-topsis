
@extends('layouts.app')

@section('title', 'Edit Alternatif')
@section('breadcrumb-active', 'Alternatif')
@section('current-page', 'Edit Alternatif')

@section('content')
<div class="card max-w-2xl mx-auto my-6">
    <div class="card-header">
        <h3 class="card-title">Form Edit Alternatif</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('alternatif.update', $alternatif->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
                <input type="text" name="kode" id="kode" value="{{ old('kode', $alternatif->kode) }}" class="form-control" required disabled>
                @error('kode') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama', $alternatif->nama) }}" class="form-control" required>
                @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                <input type="number" name="nomor_induk" id="nomor_induk" value="{{ old('nomor_induk', $alternatif->nomor_induk) }}" class="form-control" required>
                @error('nomor_induk') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ml-2">Perbarui</button>
            </div>
        </form>
    </div>
</div>
@endsection
