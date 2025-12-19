@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">Data User</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <h4><i class="bi bi-pencil-square me-2"></i>Form Edit User</h4>
        </div>

        <div class="form-body">
            {{-- Info Box --}}
            <div class="info-box">
                <i class="bi bi-info-circle-fill"></i>
                <p>
                    Anda dapat mengubah password di sini atau menggunakan fitur <strong>"Reset Password"</strong> di halaman daftar user untuk mereset password ke default (123456).
                </p>
            </div>

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

            <form action="{{ route('admin.user.update', $user->iduser) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nama --}}
                <div class="form-group">
                    <label class="form-label">
                        Nama Lengkap<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('nama') is-invalid @enderror" 
                           name="nama" 
                           value="{{ old('nama', $user->nama) }}"
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
                           value="{{ old('email', $user->email) }}"
                           placeholder="contoh@email.com"
                           required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Password Baru (Opsional) --}}
                <div class="form-group">
                    <label class="form-label">
                        Password Baru (Opsional)
                    </label>
                    <input type="password" 
                           class="form-control-custom @error('password') is-invalid @enderror" 
                           name="password"
                           placeholder="Minimal 6 karakter">
                    <small class="form-text">
                        <i class="bi bi-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengubah password
                    </small>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="form-group">
                    <label class="form-label">
                        Konfirmasi Password Baru
                    </label>
                    <input type="password" 
                           class="form-control-custom @error('password_confirmation') is-invalid @enderror" 
                           name="password_confirmation"
                           placeholder="Ulangi password baru">
                    <small class="form-text">
                        <i class="bi bi-info-circle me-1"></i>Konfirmasi password hanya diperlukan jika mengisi password baru
                    </small>
                    @error('password_confirmation')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <button type="submit" class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Update
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