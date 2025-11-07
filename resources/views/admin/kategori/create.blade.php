@extends('layouts.app')
@section('title', 'Tambah Kategori')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Kategori</h4>
                </div>

                <div class="card-body">
                    {{-- Notifikasi Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form Tambah Kategori --}}
                    <form action="{{ route('admin.kategori.store') }}" method="POST">
                        @csrf

                        {{-- Nama Kategori --}}
                        <div class="mb-3">
                            <label for="nama_kategori" class="form-label">
                                Nama Kategori <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('nama_kategori') is-invalid @enderror" 
                                id="nama_kategori"
                                name="nama_kategori"
                                value="{{ old('nama_kategori') }}"
                                placeholder="Contoh: Obat, Vaksinasi, Grooming"
                                required
                            >
                            @error('nama_kategori')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Deskripsi (Opsional) --}}
                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">
                                Deskripsi <small class="text-muted">(opsional)</small>
                            </label>
                            <textarea 
                                class="form-control @error('deskripsi') is-invalid @enderror"
                                id="deskripsi"
                                name="deskripsi"
                                rows="3"
                                placeholder="Tulis keterangan tambahan jika diperlukan...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
