@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Jenis Hewan</h2>
    <form action="{{ route('jenishewan.update', $data->idjenishewan) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Nama Jenis</label>
            <input type="text" name="nama_jenis" value="{{ $data->nama_jenis }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Keterangan</label>
            <textarea name="keterangan" class="form-control">{{ $data->keterangan }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('jenishewan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
