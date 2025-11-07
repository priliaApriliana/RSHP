@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Tambah Kode Tindakan Terapi</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="kode" class="form-label">Kode</label>
            <input type="text" class="form-control" id="kode" name="kode" maxlength="5" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi_tindakan_terapi" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="deskripsi_tindakan_terapi" name="deskripsi_tindakan_terapi" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="idkategori" class="form-label">Kategori</label>
            <select name="idkategori" id="idkategori" class="form-select" required>
                <option value="">-- Pilih Kategori --</option>
                @foreach($kategori as $k)
                    <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="idkategori_klinis" class="form-label">Kategori Klinis</label>
            <select name="idkategori_klinis" id="idkategori_klinis" class="form-select" required>
                <option value="">-- Pilih Kategori Klinis --</option>
                @foreach($kategoriKlinis as $kk)
                    <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
