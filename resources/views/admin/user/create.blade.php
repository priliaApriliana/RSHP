@extends('layouts.lte.main')

@section('page-title', 'Tambah User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Data User</a></li>
    <li class="breadcrumb-item active">Tambah</li>
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

    .form-text {
        display: block;
        margin-top: 0.5rem;
        font-size: 0.75rem;
        color: #628ECB;
        padding: 0.5rem 0.75rem;
        background: #F0F3FA;
        border-radius: 6px;
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
        justify-content: center;
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

    .btn-submit {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.3);
    }

    .btn-submit:hover {
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
            <h2>Tambah User</h2>
            <p>Isi formulir di bawah untuk menambahkan user baru</p>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <h4><i class="bi bi-person-plus-fill me-2"></i>Form Tambah User</h4>
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

            <form action="{{ route('admin.user.store') }}" method="POST">
                @csrf

                {{-- Nama --}}
                <div class="form-group">
                    <label class="form-label">
                        Nama Lengkap<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('nama') is-invalid @enderror" 
                           name="nama" 
                           value="{{ old('nama') }}"
                           placeholder="Masukkan nama lengkap"
                           required>
                    @error('nama')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label class="form-label">
                        Email<span class="required">*</span>
                    </label>
                    <input type="email" 
                           class="form-control-custom @error('email') is-invalid @enderror" 
                           name="email" 
                           value="{{ old('email') }}"
                           placeholder="contoh@email.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="form-group">
                    <label class="form-label">
                        Password (Opsional)
                    </label>
                    <input type="password" 
                           class="form-control-custom @error('password') is-invalid @enderror" 
                           name="password"
                           placeholder="Minimal 6 karakter">
                    <small class="form-text">
                        <i class="bi bi-info-circle me-1"></i>Biarkan kosong untuk menggunakan password default: <strong>123456</strong>
                    </small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <button type="submit" class="btn-custom btn-submit">
                        <i class="bi bi-check-circle"></i>
                        Simpan
                    </button>
                    <a href="{{ route('admin.user.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection