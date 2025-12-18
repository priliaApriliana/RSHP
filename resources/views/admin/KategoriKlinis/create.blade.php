@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategoriklinis.index') }}">Kategori Klinis</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Kategori Klinis
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kategoriklinis.store') }}" method="POST">
                @csrf

                <div class="form-body">
                    {{-- Error Notif --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Terdapat kesalahan
                            </div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Kategori Klinis --}}
                    <div class="input-group-wrapper">
                        <label for="nama_kategori_klinis" class="form-label-custom">
                            Nama Kategori Klinis
                            <span class="required-star">*</span>
                        </label>

                        <input 
                            type="text"
                            class="form-input-custom @error('nama_kategori_klinis') is-invalid @enderror"
                            id="nama_kategori_klinis"
                            name="nama_kategori_klinis"
                            placeholder="Contoh: Umum, Bedah, Gawat Darurat"
                            value="{{ old('nama_kategori_klinis') }}"
                            required
                        >
                        @error('nama_kategori_klinis')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama kategori klinis dengan jelas  
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.kategoriklinis.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-custom btn-save-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
