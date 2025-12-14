@extends('layouts.lte.main')

@section('page-title', 'Ubah Password')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.profil') }}">Profil</a></li>
    <li class="breadcrumb-item active">Ubah Password</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-key"></i> Ubah Password
                </h3>
            </div>

            <form action="{{ route('perawat.profil.updatePassword') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Password Lama -->
                    <div class="mb-3">
                        <label class="form-label">Password Lama <span class="text-danger">*</span></label>
                        <input type="password" 
                               name="password_lama" 
                               class="form-control @error('password_lama') is-invalid @enderror" 
                               required>
                        @error('password_lama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password Baru -->
                    <div class="mb-3">
                        <label class="form-label">Password Baru <span class="text-danger">*</span></label>
                        <input type="password" 
                               name="password_baru" 
                               class="form-control @error('password_baru') is-invalid @enderror" 
                               required>
                        @error('password_baru')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Minimal 8 karakter</small>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label class="form-label">Konfirmasi Password Baru <span class="text-danger">*</span></label>
                        <input type="password" 
                               name="password_baru_confirmation" 
                               class="form-control" 
                               required>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('perawat.profil') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-key"></i> Ubah Password
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
