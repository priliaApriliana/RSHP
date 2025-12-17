@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<style>
    /* Color Palette Variables */
    :root {
        --primary-color: #628ECB;
        --primary-dark: #395886;
        --primary-light: #8AAEE0;
        --secondary-light: #B1C9EF;
        --bg-light: #D5DEEF;
        --bg-lighter: #F0F3FA;
    }

    /* Card Styling */
    .form-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        overflow: hidden;
    }

    .form-card .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        padding: 20px 24px;
    }

    .form-card .card-title {
        color: white;
        font-weight: 700;
        font-size: 20px;
        margin: 0;
    }

    .form-card .card-title i {
        margin-right: 8px;
    }

    .form-card .card-body {
        padding: 32px 24px;
        background: #F0F3FA;
    }

    /* Alert Styling */
    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border: 2px solid #f1b0b7;
        border-radius: 12px;
        color: #721c24;
        padding: 16px 20px;
    }

    .alert-danger strong {
        font-weight: 700;
    }

    .alert-danger ul {
        padding-left: 20px;
    }

    /* Form Elements */
    .form-label {
        font-weight: 600;
        color: #395886;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-label .text-danger {
        color: #e74c3c;
    }

    .form-control,
    .form-select {
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        padding: 12px 16px;
        background: white;
        color: #395886;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
        outline: none;
        background: white;
    }

    .form-control::placeholder {
        color: #8AAEE0;
    }

    .form-control.is-invalid,
    .form-select.is-invalid {
        border-color: #e74c3c;
    }

    .form-control.is-invalid:focus,
    .form-select.is-invalid:focus {
        border-color: #e74c3c;
        box-shadow: 0 0 0 4px rgba(231, 76, 60, 0.1);
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 13px;
        font-weight: 500;
        margin-top: 6px;
    }

    textarea.form-control {
        min-height: 100px;
        resize: vertical;
    }

    /* Form Group Spacing */
    .mb-3 {
        margin-bottom: 24px !important;
    }

    /* Card Footer */
    .form-card .card-footer {
        background: #F0F3FA;
        border-top: 2px solid #D5DEEF;
        padding: 20px 24px;
    }

    /* Button Styling */
    .btn-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(138, 174, 224, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 174, 224, 0.4);
        color: white;
    }

    .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 32px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(98, 142, 203, 0.4);
        color: white;
    }

    .btn i {
        margin-right: 6px;
    }

    /* Container */
    .form-container {
        max-width: 800px;
        margin: 0 auto;
    }
</style>

<div class="form-container">
    <div class="card form-card">

        {{-- CARD HEADER --}}
        <div class="card-header">
            <h3 class="card-title">
                <i class="bi bi-person-plus-fill"></i> Tambah Pemilik
            </h3>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.pemilik.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Notifikasi Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Nomor WhatsApp --}}
                <div class="mb-3">
                    <label for="no_wa" class="form-label">
                        <i class="bi bi-whatsapp"></i> Nomor WhatsApp <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           id="no_wa"
                           name="no_wa"
                           class="form-control @error('no_wa') is-invalid @enderror"
                           placeholder="Contoh: 08123456789 atau +628123456789"
                           value="{{ old('no_wa') }}"
                           required>

                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        <i class="bi bi-house-fill"></i> Alamat <span class="text-danger">*</span>
                    </label>
                    
                    <textarea id="alamat"
                              name="alamat"
                              rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih User --}}
                <div class="mb-3">
                    <label for="iduser" class="form-label">
                        <i class="bi bi-person-fill"></i> Pilih User <span class="text-danger">*</span>
                    </label>

                    <select id="iduser"
                            name="iduser"
                            class="form-select @error('iduser') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->iduser }}"
                                {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>

                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- CARD FOOTER --}}
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection