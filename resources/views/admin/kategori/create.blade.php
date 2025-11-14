@extends('layouts.lte.main')

@section('page-title', 'Tambah Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-square-dotted"></i> Tambah Kategori
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kategori.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Notifikasi error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- NAMA KATEGORI --}}
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label fw-semibold">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text"
                            class="form-control @error('nama_kategori') is-invalid @enderror"
                            id="nama_kategori"
                            name="nama_kategori"
                            placeholder="Contoh: Obat, Vaksinasi, Grooming"
                            value="{{ old('nama_kategori') }}"
                            required
                        >
                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">
                            Deskripsi <small class="text-muted">(opsional)</small>
                        </label>
                        <textarea 
                            class="form-control @error('deskripsi') is-invalid @enderror"
                            id="deskripsi"
                            name="deskripsi"
                            rows="3"
                            placeholder="Tulis keterangan tambahan jika diperlukan..."
                        >{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
