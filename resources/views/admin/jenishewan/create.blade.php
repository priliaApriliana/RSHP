@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jenishewan.index') }}">Jenis Hewan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="container-fluid px-3">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Jenis Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.jenishewan.store') }}" method="POST">
                @csrf

                <div class="form-body">
                    {{-- Error Notif --}}
                    @if (session('error'))
                        <div class="alert-error">
                            <p class="alert-error-text">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif

                    {{-- Input Group --}}
                    <div class="input-group-wrapper">
                        <label for="nama_jenis_hewan" class="form-label-custom">
                            Nama Jenis Hewan
                            <span class="required-star">*</span>
                        </label>

                        <input 
                            type="text"
                            name="nama_jenis_hewan"
                            id="nama_jenis_hewan"
                            class="form-input-custom @error('nama_jenis_hewan') is-invalid @enderror"
                            placeholder="Contoh: Anjing (Canis lupus familiaris)"
                            value="{{ old('nama_jenis_hewan') }}"
                            required
                        >

                        @error('nama_jenis_hewan')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama lengkap jenis hewan beserta nama ilmiahnya
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.jenishewan.index') }}" class="btn-custom btn-back-custom">
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