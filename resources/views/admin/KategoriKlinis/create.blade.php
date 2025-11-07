@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kategori Klinis</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kategoriklinis.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nama_kategori_klinis" class="form-label">Nama Kategori Klinis</label>
            <input type="text" class="form-control" id="nama_kategori_klinis" name="nama_kategori_klinis" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
