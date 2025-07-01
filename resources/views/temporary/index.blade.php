@extends('layouts.app')
@section('title', 'Upload Excel Alternatif')

@section('content')
<div class="card p-4">
    <h3>Upload Data Alternatif (Temporary Table)</h3>

    @if(session('error'))
        <div class="alert alert-danger mt-2">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('temporary.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="excel_file">Pilih File Excel</label>
            <input type="file" name="excel_file" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Upload & Preview</button>
    </form>
</div>
@endsection
