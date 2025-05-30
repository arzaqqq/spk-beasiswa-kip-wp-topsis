@extends('layouts.app')

@section('title', 'Tambah Alternatif')
@section('breadcrumb-active', 'Alternatif')
@section('current-page', 'Tambah Alternatif')

@section('content')
<div class="card max-w-2xl mx-auto my-6">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Alternatif</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('alternatif.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="kode" class="block text-sm font-medium text-gray-700">Kode</label>
                <input type="text" id="kode" value="{{ $nextKode }}" class="form-control bg-gray-100" disabled>
                <input type="hidden" name="kode" value="{{ $nextKode }}">
            </div>

            <div>
                <label for="nama" class="block text-sm font-medium text-gray-700">Nama</label>
                <input type="text" name="nama" id="nama" value="{{ old('nama') }}" class="form-control" required>
                @error('nama') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div>
                <label for="nomor_induk" class="block text-sm font-medium text-gray-700">Nomor Induk</label>
                <input type="number" name="nomor_induk" id="nomor_induk" value="{{ old('nomor_induk') }}" class="form-control" required>
                @error('nomor_induk') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary ml-2">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
