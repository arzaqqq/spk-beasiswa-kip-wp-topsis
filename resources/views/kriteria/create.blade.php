@extends('layouts.app')

@section('title', 'Tambah Kriteria')
@section('page-title', 'Tambah Kriteria')
@section('breadcrumb-active', 'Tambah Kriteria')

@section('content')
<div class="card max-w-2xl mx-auto my-6">
    <div class="card-header">
        <h3 class="card-title">Form Tambah Kriteria</h3>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('kriteria.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <label for="kode" class="block text-sm font-medium text-gray-700">Kode Kriteria</label>
                    <select name="kode" id="kode"
                            class="mt-1 block w-full h-9 px-2 rounded-md border-gray-100 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            required>
                        <option value="" disabled selected>Pilih Kode</option>
                        @foreach (range(1, 10) as $i)
                            <option value="C{{ $i }}" {{ old('kode') == 'C'.$i ? 'selected' : '' }}>C{{ $i }}</option>
                        @endforeach
                    </select>
                    @error('kode')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">Nama Kriteria</label>
                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}"
                        class="mt-1 block w-full h-9 px-2 rounded-md border-gray-100 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                        required maxlength="100">
                    @error('nama')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Jenis Kriteria</label>
                    <div class="mt-2 space-x-4">
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis" value="benefit" {{ old('jenis') == 'benefit' ? 'checked' : '' }}
                                class="form-radio text-blue-600" required>
                            <span class="ml-2">Benefit</span>
                        </label>
                        <label class="inline-flex items-center">
                            <input type="radio" name="jenis" value="cost" {{ old('jenis') == 'cost' ? 'checked' : '' }}
                                class="form-radio text-blue-600" required>
                            <span class="ml-2">Cost</span>
                        </label>
                    </div>
                    @error('jenis')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="bobot" class="block text-sm font-medium text-gray-700">Bobot</label>
                    <select name="bobot" id="bobot"
                            class="mt-1 block w-full h-9 px-2 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            required>
                        <option value="" disabled selected>Pilih Bobot</option>
                        @foreach ([0.100, 0.150, 0.200, 0.250, 0.300, 0.350, 0.400, 0.450, 0.500] as $b)
                            <option value="{{ number_format($b, 3) }}" {{ old('bobot') == number_format($b, 3) ? 'selected' : '' }}>
                                {{ number_format($b, 3) }}
                            </option>
                        @endforeach
                    </select>
                    @error('bobot')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi (Opsional)</label>
                    <textarea name="deskripsi" id="deskripsi" rows="4"
                            class="mt-1 block px-2 w-full rounded-md border-gray-100 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end space-x-3">
                    <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">
                        Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        Simpan
                    </button>
                </div>
            </form>

    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@4.0.0-alpha.1/dist/tailwind.min.css">
@endpush
@endsection
