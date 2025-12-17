@extends('layouts.lte.main')

@section('page-title', 'Edit User')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Data User</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<style>
    /* ===== PAGE HEADER ===== */
    .page-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 14px;
        padding: 1.5rem 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 3px 10px rgba(57, 88, 134, 0.12);
    }

    .page-header h2 {
        color: #fff;
        font-size: 1.35rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }

    .page-header p {
        color: rgba(255,255,255,0.85);
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    .user-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.2);
        padding: 0.35rem 0.9rem;
        border-radius: 20px;
        color: #fff;
        font-size: 0.8rem;
        font-weight: 600;
    }

    /* ===== FORM CARD ===== */
    .form-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
        overflow: hidden;
    }

    .form-header {
        background: linear-gradient(to bottom, #F0F3FA 0%, #ffffff 100%);
        padding: 1.25rem 1.5rem;
        border-bottom: 2px solid #D5DEEF;
    }

    .form-header h4 {
        color: #395886;
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
    }

    .form-body {
        padding: 1.75rem 2rem 2rem;
    }

    /* ===== INFO BOX ===== */
    .info-box {
        display: flex;
        gap: 0.75rem;
        padding: 0.85rem 1rem;
        background: #F0F3FA;
        border-radius: 10px;
        border-left: 4px solid #628ECB;
        margin-bottom: 1.5rem;
        font-size: 0.8rem;
    }

    .info-box i {
        color: #628ECB;
        font-size: 1.2rem;
    }

    .info-box p {
        margin: 0;
        color: #395886;
        line-height: 1.6;
    }

    /* ===== FORM ===== */
    .form-group {
        margin-bottom: 1.5rem;
        max-width: 520px;
    }

    .form-label {
        font-weight: 600;
        font-size: 0.85rem;
        color: #395886;
        margin-bottom: 0.4rem;
    }

    .form-label .required {
        color: #d63031;
        margin-left: 0.25rem;
    }

    .form-control-custom {
        width: 100%;
        padding: 0.7rem 0.9rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.85rem;
        color: #395886;
        transition: 0.3s;
    }

    .form-control-custom:focus {
        border-color: #8AAEE0;
        box-shadow: 0 0 0 4px rgba(138,174,224,0.12);
        outline: none;
    }

    .form-control-custom.is-invalid {
        border-color: #d63031;
    }

    .invalid-feedback {
        display: block;
        margin-top: 0.4rem;
        font-size: 0.75rem;
        color: #d63031;
        font-weight: 600;
    }

    /* ===== FOOTER ===== */
    .form-footer {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        padding-top: 1.75rem;
        border-top: 1px solid #D5DEEF;
    }

    .btn-custom {
        padding: 0.7rem 1.8rem;
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: 0.3s;
        border: none;
        text-decoration: none;
        cursor: pointer;
    }

    .btn-update {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #fff;
        box-shadow: 0 2px 8px rgba(98,142,203,0.3);
    }

    .btn-update:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98,142,203,0.4);
    }

    .btn-cancel {
        background: #E8EDF5;
        color: #395886;
    }

    .btn-cancel:hover {
        background: #D5DEEF;
        transform: translateY(-2px);
    }

    /* ===== ALERT ===== */
    .alert-danger {
        background: #fff5f5;
        color: #c53030;
        border-left: 4px solid #d63031;
        border-radius: 10px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        font-size: 0.8rem;
    }
</style>

<div class="container-fluid px-4 d-flex justify-content-center">
    <div style="width:100%; max-width: 900px;">

        {{-- PAGE HEADER --}}
        <div class="page-header">
            <h2>Edit User</h2>
            <p>Perbarui informasi user</p>
            <div class="user-badge">
                <i class="bi bi-person-badge"></i>
                ID User: {{ $user->iduser }}
            </div>
        </div>

        {{-- FORM CARD --}}
        <div class="form-card">
            <div class="form-header">
                <h4><i class="bi bi-pencil-square me-2"></i>Form Edit User</h4>
            </div>

            <div class="form-body">

                {{-- INFO --}}
                <div class="info-box">
                    <i class="bi bi-info-circle-fill"></i>
                    <p>
                        Password tidak dapat diubah melalui form ini. Gunakan fitur
                        <strong>Reset Password</strong> pada halaman daftar user.
                    </p>
                </div>

                {{-- ERROR --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terjadi kesalahan:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label class="form-label">
                            Nama Lengkap<span class="required">*</span>
                        </label>
                        <input type="text"
                               name="nama"
                               value="{{ old('nama', $user->nama) }}"
                               class="form-control-custom @error('nama') is-invalid @enderror"
                               placeholder="Masukkan nama lengkap"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label class="form-label">
                            Email<span class="required">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $user->email) }}"
                               class="form-control-custom @error('email') is-invalid @enderror"
                               placeholder="contoh@email.com"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FOOTER --}}
                    <div class="form-footer">
                        <button type="submit" class="btn-custom btn-update">
                            <i class="bi bi-check-circle"></i> Update
                        </button>
                        <a href="{{ route('admin.user.index') }}" class="btn-custom btn-cancel">
                            <i class="bi bi-x-circle"></i> Batal
                        </a>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>

@endsection
