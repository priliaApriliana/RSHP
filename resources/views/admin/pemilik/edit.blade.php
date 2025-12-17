@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(57, 88, 134, 0.15);
    }
    
    .page-header h2 {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        letter-spacing: -0.5px;
    }
    
    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.875rem;
        margin: 0.5rem 0 0 0;
    }

    .page-header .pemilik-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        padding: 0.375rem 1rem;
        border-radius: 20px;
        color: #ffffff;
        font-size: 0.8125rem;
        font-weight: 600;
        margin-top: 0.75rem;
    }

    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
        overflow: hidden;
        max-width: 700px;
        margin: 0 auto;
    }

    .form-header {
        background: linear-gradient(to bottom, #F0F3FA 0%, #ffffff 100%);
        padding: 1.5rem;
        border-bottom: 2px solid #D5DEEF;
    }

    .form-header h4 {
        color: #395886;
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0;
    }

    .form-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: #395886;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .form-label .required {
        color: #d63031;
        margin-left: 0.25rem;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #395886;
    }

    .form-control-custom:focus {
        border-color: #8AAEE0;
        box-shadow: 0 0 0 4px rgba(138, 174, 224, 0.1);
        outline: none;
    }

    .form-control-custom.is-invalid {
        border-color: #d63031;
    }

    textarea.form-control-custom {
        resize: vertical;
        min-height: 100px;
    }

    .form-select-custom {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #395886;
        cursor: pointer;
    }

    .form-select-custom:focus {
        border-color: #8AAEE0;
        box-shadow: 0 0 0 4px rgba(138, 174, 224, 0.1);
        outline: none;
    }

    .form-select-custom.is-invalid {
        border-color: #d63031;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: #d63031;
        font-weight: 600;
    }

    .form-footer {
        display: flex;
        gap: 1rem;
        justify-content: space-between;
        padding-top: 1.5rem;
        border-top: 1px solid #D5DEEF;
    }

    .btn-custom {
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-update {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.4);
        color: #ffffff;
    }

    .btn-cancel {
        background: #e8edf5;
        color: #395886;
    }

    .btn-cancel:hover {
        background: #D5DEEF;
        color: #395886;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border: none;
    }

    .alert-danger {
        background: #fff5f5;
        color: #c53030;
        border-left: 4px solid #d63031;
    }

    .alert ul {
        margin: 0.5rem 0 0 0;
        padding-left: 1.5rem;
    }
</style>

<div class="container-fluid px-4">
    {{-- Page Header --}}
    <div class="page-header">
        <div>
            <h2>Edit Data Pemilik</h2>
            <p>Perbarui informasi data pemilik</p>
            <div class="pemilik-badge">
                <i class="bi bi-person-badge"></i>
                <span>ID Pemilik: {{ $pemilik->idpemilik }}</span>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <h4><i class="bi bi-pencil-square me-2"></i>Form Edit Data Pemilik</h4>
        </div>

        <div class="form-body">
            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nomor WhatsApp --}}
                <div class="form-group">
                    <label class="form-label">
                        Nomor WhatsApp<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('no_wa') is-invalid @enderror" 
                           name="no_wa" 
                           value="{{ old('no_wa', $pemilik->no_wa) }}"
                           placeholder="Contoh: 08123456789"
                           required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label class="form-label">
                        Alamat<span class="required">*</span>
                    </label>
                    <textarea name="alamat"
                              class="form-control-custom @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat', $pemilik->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih User --}}
                <div class="form-group">
                    <label class="form-label">
                        Pilih User<span class="required">*</span>
                    </label>
                    <select name="iduser"
                            class="form-select-custom @error('iduser') is-invalid @enderror"
                            required>
                        <option value="" disabled>-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->iduser }}"
                                {{ old('iduser', $pemilik->iduser) == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-custom btn-update">
                        <i class="bi bi-check-circle"></i>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection