@extends('layouts.lte.main')

@section('page-title', 'Profil Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')

<style>
    :root {
        --primary-blue: #628ECB;
        --light-blue: #8AAEE0;
        --lighter-blue: #B1C9EF;
        --lightest-blue: #D5DEEF;
        --very-light-blue: #F0F3FA;
        --dark-blue: #395686;
    }

    .gradient-header-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
    }

    .gradient-header-light {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
    }

    .avatar-lg {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
    }

    .profile-card {
        border: 1px solid #e0e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        box-shadow: 0 10px 30px rgba(98, 142, 203, 0.15) !important;
    }

    .info-badge {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
    }

    .info-box {
        background-color: #f5f8fc;
        border-left: 4px solid var(--primary-blue);
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .info-box:hover {
        background-color: #f0f3fa;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.1);
    }
</style>

<div class="row g-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card profile-card border-0 shadow-sm">
            <div class="card-header gradient-header-blue text-white text-center py-4 border-0">
                <h5 class="mb-0 fw-bold">Profil Dokter</h5>
            </div>
            <div class="card-body text-center p-4">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto mb-3">
                        <i class="bi bi-person-fill fs-1 text-white"></i>
                    </div>
                </div>
                <h4 class="fw-bold text-dark mb-1">{{ $user->nama ?? '-' }}</h4>
                <p class="text-muted mb-4">Dokter Hewan</p>
                <hr class="my-3">
                <div class="text-start">
                    <div class="info-box mb-3">
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-envelope-fill me-2" style="color: var(--primary-blue);"></i>Email
                        </small>
                        <strong class="text-dark">{{ $user->email ?? '-' }}</strong>
                    </div>
                    <div class="info-box">
                        <small class="text-muted d-block mb-1">
                            <i class="bi bi-check-circle-fill me-2" style="color: var(--primary-blue);"></i>Status
                        </small>
                        <span class="badge" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%);">Aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Details Section -->
    <div class="col-lg-8">
        <!-- Personal Information -->
        <div class="card profile-card border-0 shadow-sm mb-4">
            <div class="card-header gradient-header-blue text-white border-0 py-3">
                <h5 class="card-title text-white mb-0">
                    <i class="bi bi-id-card me-2"></i> Informasi Pribadi
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-person me-2" style="color: var(--primary-blue);"></i>Nama Lengkap
                        </small>
                        <p class="form-control-plaintext fw-bold text-dark">{{ $user->nama ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-at me-2" style="color: var(--primary-blue);"></i>Username
                        </small>
                        <p class="form-control-plaintext text-dark">{{ $user->username ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-envelope me-2" style="color: var(--primary-blue);"></i>Email
                        </small>
                        <p class="form-control-plaintext text-dark">{{ $user->email ?? '-' }}</p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-telephone me-2" style="color: var(--primary-blue);"></i>No. WhatsApp
                        </small>
                        <p class="form-control-plaintext text-dark">{{ $user->no_wa ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Professional Information -->
        <div class="card profile-card border-0 shadow-sm mb-4">
            <div class="card-header gradient-header-light text-white border-0 py-3">
                <h5 class="card-title text-white mb-0">
                    <i class="bi bi-stethoscope me-2"></i> Informasi Profesional
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-briefcase me-2" style="color: var(--light-blue);"></i>Role
                        </small>
                        <p class="form-control-plaintext">
                            <span class="badge" style="background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);">
                                {{ $roleUser->nama_role ?? 'Dokter' }}
                            </span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-hash me-2" style="color: var(--light-blue);"></i>ID Role User
                        </small>
                        <p class="form-control-plaintext text-dark">{{ $roleUser->idrole_user ?? '-' }}</p>
                    </div>
                    <div class="col-12">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-shield-check me-2" style="color: var(--light-blue);"></i>Status Akun
                        </small>
                        <p class="form-control-plaintext">
                            <span class="badge" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%);">
                                <i class="bi bi-check-circle me-1"></i> Aktif
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Account Information -->
        <div class="card profile-card border-0 shadow-sm">
            <div class="card-header gradient-header-blue text-white border-0 py-3">
                <h5 class="card-title text-white mb-0">
                    <i class="bi bi-lock me-2"></i> Informasi Akun
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-4">
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-calendar me-2" style="color: var(--primary-blue);"></i>Terdaftar Sejak
                        </small>
                        <p class="form-control-plaintext text-dark">
                            {{ $user->created_at ? $user->created_at->format('d M Y') : '-' }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <small class="text-muted d-block mb-2">
                            <i class="bi bi-clock me-2" style="color: var(--primary-blue);"></i>Terakhir Update
                        </small>
                        <p class="form-control-plaintext text-dark">
                            {{ $user->updated_at ? $user->updated_at->format('d M Y H:i') : '-' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
