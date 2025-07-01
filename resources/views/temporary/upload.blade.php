@extends('layouts.app')
@section('title', 'Upload Excel Alternatif')

@section('content')
<div class="card p-4">
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
