@extends('layouts.app')
@section('title', 'Preview dan Pilih Kolom')

@section('content')
<form action="{{ route('temporary.storeSelected') }}" method="POST">
    @csrf
    <div class="card p-4">
        <p><strong>Pilih kolom yang akan disimpan ke tabel Alternatif:</strong></p>

        @foreach(session('excel_headers') as $header)
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="fields[]" value="{{ $header }}" id="{{ $header }}">
                <label class="form-check-label" for="{{ $header }}">{{ ucfirst(str_replace('_', ' ', $header)) }}</label>
            </div>
        @endforeach

        <button class="btn btn-success mt-3">Simpan ke Alternatif</button>
    </div>
</form>

<div class="mt-4">
    <h4>Data Preview</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                @foreach(session('excel_headers') as $header)
                    <th>{{ ucfirst(str_replace('_', ' ', $header)) }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach(session('excel_data') as $row)
                <tr>
                    @foreach(session('excel_headers') as $header)
                        <td>{{ $row[$header] ?? '' }}</td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
