@extends('layouts.lte.main')

@section('page-title', 'Tambah Ras Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.rashewan.index') }}">Ras Hewan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<style>
    .form-wrapper {
        max-width: 1000px;
        margin: 0;
        margin-left: 2rem;
        margin-right: auto;
    }
    
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(57, 88, 134, 0.1);
        overflow: hidden;
        border: 1px solid #D5DEEF;
    }
    
    .form-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        padding: 1.5rem 2rem;
        border-bottom: 3px solid #395886;
    }
    
    .form-header-title {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    
    .form-header-title i {
        font-size: 1.375rem;
    }
    
    .form-body {
        padding: 2rem;
        background: #F8FAFC;
    }
    
    .alert-error {
        background: #ffffff;
        border: 2px solid #ff6b6b;
        border-left: 5px solid #d63031;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }
    
    .alert-error-text {
        color: #d63031;
        font-size: 0.9375rem;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .alert-error-text i {
        font-size: 1.125rem;
    }
    
    .input-group-wrapper {
        background: #ffffff;
        padding: 1.5rem;
        border-radius: 12px;
        border: 2px solid #D5DEEF;
        margin-bottom: 1.25rem;
    }
    
    .form-label-custom {
        display: block;
        font-weight: 700;
        color: #395886;
        margin-bottom: 0.75rem;
        font-size: 0.9375rem;
    }
    
    .required-star {
        color: #d63031;
        margin-left: 0.25rem;
        font-size: 1rem;
    }
    
    .form-input-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #2c3e50;
        font-weight: 500;
    }
    
    .form-input-custom:focus {
        border-color: #628ECB;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.15);
        outline: none;
    }
    
    .form-input-custom::placeholder {
        color: #95a5a6;
        font-weight: 400;
    }
    
    .form-select-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #2c3e50;
        font-weight: 500;
    }
    
    .form-select-custom:focus {
        border-color: #628ECB;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.15);
        outline: none;
    }
    
    .form-input-custom.is-invalid,
    .form-select-custom.is-invalid {
        border-color: #e74c3c;
        background: #fff5f5;
    }
    
    .error-message {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: #e74c3c;
        font-size: 0.8125rem;
        margin-top: 0.5rem;
        font-weight: 600;
    }
    
    .error-message i {
        font-size: 0.875rem;
    }
    
    .helper-text {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.8125rem;
        color: #628ECB;
        margin-top: 0.5rem;
    }
    
    .form-footer {
        background: linear-gradient(to right, #F0F3FA 0%, #ffffff 100%);
        padding: 1.5rem 2rem;
        border-top: 2px solid #D5DEEF;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .btn-custom {
        padding: 0.75rem 1.75rem;
        border-radius: 10px;
        font-size: 0.9375rem;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .btn-back-custom {
        background: #ffffff;
        color: #628ECB;
        border: 2px solid #628ECB;
    }
    
    .btn-back-custom:hover {
        background: #628ECB;
        color: #ffffff;
        transform: translateX(-3px);
        box-shadow: 0 4px 8px rgba(98, 142, 203, 0.3);
    }
    
    .btn-save-custom {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(98, 142, 203, 0.3);
    }
    
    .btn-save-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(98, 142, 203, 0.4);
        color: #ffffff;
    }
</style>

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Ras Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.rashewan.store') }}" method="POST">
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

                    {{-- Input Nama Ras --}}
                    <div class="input-group-wrapper">
                        <label for="nama_ras" class="form-label-custom">
                            Nama Ras Hewan
                            <span class="required-star">*</span>
                        </label>

                        <input 
                            type="text"
                            id="nama_ras"
                            name="nama_ras"
                            class="form-input-custom @error('nama_ras') is-invalid @enderror"
                            placeholder="Contoh: Golden Retriever, Persia, Maine Coon"
                            value="{{ old('nama_ras') }}"
                            required
                        >

                        @error('nama_ras')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama ras hewan yang spesifik
                            </div>
                        @enderror
                    </div>

                    {{-- Pilih Jenis Hewan --}}
                    <div class="input-group-wrapper">
                        <label for="idjenis_hewan" class="form-label-custom">
                            Jenis Hewan
                            <span class="required-star">*</span>
                        </label>

                        <select 
                            id="idjenis_hewan"
                            name="idjenis_hewan"
                            class="form-select-custom @error('idjenis_hewan') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenisHewan as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}"
                                    {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}
                                >
                                    {{ $jenis->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>

                        @error('idjenis_hewan')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Pilih kategori jenis hewan yang sesuai
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.rashewan.index') }}" class="btn-custom btn-back-custom">
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