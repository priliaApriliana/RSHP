@extends('layouts.lte.main')

@section('page-title', 'Tambah Kode Tindakan Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
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
    
    .alert-error-title {
        color: #d63031;
        font-size: 0.9375rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .alert-error-title i {
        font-size: 1.125rem;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 1.75rem;
        list-style: disc;
    }
    
    .alert-error li {
        color: #e74c3c;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
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
    
    .optional-text {
        color: #95a5a6;
        font-weight: 400;
        font-size: 0.8125rem;
        margin-left: 0.25rem;
    }
    
    .form-input-custom,
    .form-textarea-custom {
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
    
    .form-textarea-custom {
        resize: vertical;
        min-height: 100px;
        font-family: inherit;
    }
    
    .form-input-custom:focus,
    .form-textarea-custom:focus {
        border-color: #628ECB;
        background: #ffffff;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.15);
        outline: none;
    }
    
    .form-input-custom::placeholder,
    .form-textarea-custom::placeholder {
        color: #95a5a6;
        font-weight: 400;
    }
    
    .form-input-custom.is-invalid,
    .form-textarea-custom.is-invalid {
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

    /* AUTO CODE DISPLAY STYLES */
    .auto-code-display {
        background: linear-gradient(135deg, #E8F4F8 0%, #D5DEEF 100%);
        border: 2px dashed #628ECB;
        border-radius: 12px;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.1);
    }

    .auto-code-label {
        font-size: 0.8125rem;
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.625rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .auto-code-label i {
        color: #628ECB;
        font-size: 1rem;
    }

    .auto-code-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: #395886;
        font-family: 'Courier New', monospace;
        letter-spacing: 3px;
        text-align: center;
        padding: 0.5rem;
        background: rgba(255, 255, 255, 0.7);
        border-radius: 8px;
        margin-bottom: 0.625rem;
    }

    .auto-code-info {
        font-size: 0.75rem;
        color: #628ECB;
        display: flex;
        align-items: center;
        gap: 0.375rem;
        justify-content: center;
    }

    .auto-code-info i {
        font-size: 0.875rem;
    }
</style>

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Kode Tindakan Terapi
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
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

                    {{-- AUTO GENERATED CODE DISPLAY --}}
                    <div class="auto-code-display">
                        <div class="auto-code-label">
                            <i class="bi bi-magic"></i>
                            Kode Otomatis (akan digenerate saat menyimpan)
                        </div>
                        <div class="auto-code-value">{{ $nextCode }}</div>
                        <div class="auto-code-info">
                            <i class="bi bi-info-circle-fill"></i>
                            Kode akan digenerate secara otomatis oleh sistem
                        </div>
                    </div>

                    {{-- DESKRIPSI, Nama Tindakan Terapi --}}
                    <div class="mb-3">
                        <label class="form-label">Nama Tindakan Terapi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi_tindakan_terapi" 
                                  class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Masukkan deskripsi tindakan terapi..."
                                  required>{{ old('deskripsi_tindakan_terapi') }}</textarea>

                        @error('deskripsi_tindakan_terapi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select name="idkategori" 
                                class="form-select @error('idkategori') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->idkategori }}" 
                                    {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI KLINIS --}}
                    <div class="mb-3">
                        <label class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                        <select name="idkategori_klinis" 
                                class="form-select @error('idkategori_klinis') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih Kategori Klinis --</option>
                            @foreach($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}"
                                    {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
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