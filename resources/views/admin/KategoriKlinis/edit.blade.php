@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategoriklinis.index') }}">Kategori Klinis</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Kategori Klinis
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.kategoriklinis.update', $data->idkategori_klinis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">
                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Terjadi kesalahan
                            </div>
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
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

                        <input type="text"
                               id="nama_kategori_klinis"
                               name="nama_kategori_klinis"
                               class="form-input-custom @error('nama_kategori_klinis') is-invalid @enderror"
                               placeholder="Contoh: Umum, Bedah, Gigi"
                               value="{{ old('nama_kategori_klinis', $data->nama_kategori_klinis) }}"
                               required>

                        @error('nama_kategori_klinis')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Perbarui nama kategori klinis yang jelas dan spesifik
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

                    <button type="submit" class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Update Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection