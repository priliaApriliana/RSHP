@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('admin.user.index') }}">Data User</a>
    </li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')
<div class="container-fluid px-4">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h4>
                    <i class="bi bi-person-plus-fill"></i>
                    Form Tambah User
                </h4>
            </div>

            {{-- BODY --}}
            <div class="form-body">

                {{-- ALERT ERROR --}}
                @if ($errors->any())
                    <div class="alert-danger">
                        <div class="alert-error-title">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            Terdapat kesalahan:
                        </div>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.user.store') }}" method="POST">
                    @csrf

                    {{-- NAMA --}}
                    <div class="form-group">
                        <label class="form-label">
                            Nama Lengkap
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="text"
                            name="nama"
                            class="form-control-custom @error('nama') is-invalid @enderror"
                            value="{{ old('nama') }}"
                            placeholder="Masukkan nama lengkap"
                            required
                        >
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- EMAIL --}}
                    <div class="form-group">
                        <label class="form-label">
                            Email
                            <span class="required-star">*</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            class="form-control-custom @error('email') is-invalid @enderror"
                            value="{{ old('email') }}"
                            placeholder="contoh@email.com"
                            required
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group">
                        <label class="form-label">
                            Password
                            <span class="optional-text">(Opsional)</span>
                        </label>
                        <input
                            type="password"
                            name="password"
                            class="form-control-custom @error('password') is-invalid @enderror"
                            placeholder="Minimal 6 karakter"
                        >
                        <small class="helper-text">
                            <i class="bi bi-info-circle"></i>
                            Kosongkan untuk password default:
                            <strong>123456</strong>
                        </small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- FOOTER --}}
                    <div class="form-footer">
                        <a href="{{ route('admin.user.index') }}"
                           class="btn-custom btn-back-custom">
                            <i class="bi bi-arrow-left-circle"></i>
                            Batal
                        </a>

                        <button type="submit"
                                class="btn-custom btn-save-custom">
                            <i class="bi bi-check-circle"></i>
                            Simpan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection
