@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
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
                    Tambah Kategori
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.kategori.store') }}" method="POST">
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

                    {{-- Nama Kategori --}}
                    <div class="input-group-wrapper">
                        <label for="nama_kategori" class="form-label-custom">
                            Nama Kategori
                            <span class="required-star">*</span>
                        </label>

                        <input 
                            type="text"
                            class="form-input-custom @error('nama_kategori') is-invalid @enderror"
                            id="nama_kategori"
                            name="nama_kategori"
                            placeholder="Contoh: Obat, Vaksinasi, Grooming"
                            value="{{ old('nama_kategori') }}"
                            required
                        >

                        @error('nama_kategori')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama kategori yang jelas dan spesifik
                            </div>
                        @enderror
                    </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.kategori.index') }}" class="btn-custom btn-back-custom">
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