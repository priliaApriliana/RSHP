@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Jenis Hewan</h2>
        <form action="{{ route('jenishewan.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Nama Jenis</label>
                <input type="text" name="nama_jenis" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Keterangan</label>
                <textarea name="keterangan" class="form-control"></textarea>
            </div>
            <button class="btn btn-success">Simpan</button>
            <a href="{{ route('jenishewan.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
</div>
@endsection
