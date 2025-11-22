@extends('layouts.lte.main')

@section('page-title', 'Tambah Tindakan Terapi')

@section('content')

<div class="card">
    <div class="card-body">

        <form action="{{ route('perawat.tindakan.store') }}" method="POST">
            @csrf

            {{-- KODE --}}
            <div class="mb-3">
                <label class="form-label">Kode <span class="text-danger">*</span></label>
                <input type="text" name="kode"
                       class="form-control @error('kode') is-invalid @enderror"
                       placeholder="Contoh: T001">

                @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi_tindakan_terapi"
                          class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                          rows="3"></textarea>

                @error('deskripsi_tindakan_terapi') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori <span class="text-danger">*</span></label>
                <select name="idkategori" class="form-control">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach ($kategori as $k)
                        <option value="{{ $k->idkategori }}">{{ $k->nama_kategori }}</option>
                    @endforeach
                </select>
            </div>

            {{-- KATEGORI KLINIS --}}
            <div class="mb-3">
                <label class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                <select name="idkategori_klinis" class="form-control">
                    <option value="">-- Pilih Kategori Klinis --</option>
                    @foreach ($kategoriKlinis as $kk)
                        <option value="{{ $kk->idkategori_klinis }}">{{ $kk->nama_kategori_klinis }}</option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('perawat.tindakan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-primary float-end">
                <i class="bi bi-save"></i> Simpan
            </button>

        </form>

    </div>
</div>

@endsection
