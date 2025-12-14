@extends('layouts.lte.main')

@section('page-title', 'Dashboard Dokter')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<style>
    .welcome-card {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%) !important;
        color: white;
    }
    
    .welcome-card .bi-stethoscope {
        color: rgba(255, 255, 255, 0.3);
    }
</style>

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card welcome-card shadow-lg border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-2 fw-bold">
                            <i class="bi bi-heart-pulse"></i> Selamat Datang, Dokter!
                        </h4>
                        <p class="mb-0" style="opacity: 0.9;">
                            Kelola rekam medis dan jadwal praktik Anda dengan mudah
                        </p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="bi bi-stethoscope" style="font-size: 4rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <!-- Card Total Rekam Medis -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle" style="background-color: rgba(98, 142, 203, 0.15); padding: 0.75rem;">
                            <i class="bi bi-file-medical-fill" style="font-size: 2rem; color: #628ECB;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Total Rekam Medis</div>
                        <h2 class="mb-0 fw-bold" style="color: #628ECB;">{{ $totalRekamMedis ?? 1 }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ url('/dokter/rekam-medis') }}" class="text-decoration-none small" style="color: #628ECB;">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Rekam Medis Hari Ini -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle" style="background-color: rgba(138, 174, 224, 0.2); padding: 0.75rem;">
                            <i class="bi bi-calendar-check-fill" style="font-size: 2rem; color: #8AAEE0;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Rekam Medis Hari Ini</div>
                        <h2 class="mb-0 fw-bold" style="color: #8AAEE0;">{{ $rekamMedisHariIni ?? 1 }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <span class="small text-muted">
                        <i class="bi bi-clock"></i> Update hari ini
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Pasien -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle" style="background-color: rgba(177, 201, 239, 0.25); padding: 0.75rem;">
                            <i class="bi bi-people-fill" style="font-size: 2rem; color: #B1C9EF;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Pasien Terdaftar</div>
                        <h2 class="mb-0 fw-bold" style="color: #B1C9EF;">{{ $pasienTerdaftar ?? 6 }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ url('/dokter/pasien') }}" class="text-decoration-none small" style="color: #B1C9EF;">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-lightning-charge-fill" style="color: #628ECB;"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/dokter/rekam-medis/create') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #628ECB;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-file-earmark-plus-fill" style="font-size: 3rem; color: #628ECB;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Buat Rekam Medis</h6>
                                    <p class="text-muted small mb-0">Input rekam medis baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/dokter/rekam-medis') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #8AAEE0;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-list-check" style="font-size: 3rem; color: #8AAEE0;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Lihat Rekam Medis</h6>
                                    <p class="text-muted small mb-0">Daftar semua rekam medis</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/dokter/jadwal-praktik') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #B1C9EF;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-week-fill" style="font-size: 3rem; color: #B1C9EF;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Jadwal Praktik</h6>
                                    <p class="text-muted small mb-0">Kelola jadwal praktik</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/dokter/pasien') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #D5DEEF;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-person-lines-fill" style="font-size: 3rem; color: #D5DEEF;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Data Pasien</h6>
                                    <p class="text-muted small mb-0">Lihat data pasien</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Today's Schedule & Important Notes -->
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-calendar-event-fill" style="color: #628ECB;"></i> Jadwal Hari Ini
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="border-0 mb-3 p-3 rounded" style="background-color: rgba(98, 142, 203, 0.1); border-left: 4px solid #628ECB;">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-info-circle-fill fs-4" style="color: #628ECB;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-2" style="color: #628ECB;">Pasien Hari Ini</h6>
                            <p class="mb-2 small">
                                Anda memiliki <strong>{{ $rekamMedisHariIni ?? 1 }} pasien</strong> yang perlu diperiksa hari ini.
                            </p>
                            <a href="{{ url('/dokter/rekam-medis') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>

                <div class="border-0 p-3 rounded" style="background-color: rgba(177, 201, 239, 0.1); border-left: 4px solid #B1C9EF;">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-exclamation-triangle-fill fs-4" style="color: #B1C9EF;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-2" style="color: #B1C9EF;">Reminder</h6>
                            <p class="mb-0 small">
                                Pastikan untuk melengkapi diagnosis dan resep untuk setiap pasien yang telah diperiksa.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Medical Tips -->
        <div class="card border-0 shadow-sm mt-3">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-lightbulb-fill" style="color: #8AAEE0;"></i> Tips Praktik
                </h5>
            </div>
            <div class="card-body p-4">
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill" style="color: #628ECB;"></i>
                        <span class="ms-2">Selalu dokumentasikan setiap pemeriksaan dengan lengkap</span>
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle-fill" style="color: #628ECB;"></i>
                        <span class="ms-2">Berikan penjelasan yang jelas kepada pasien tentang diagnosis</span>
                    </li>
                    <li class="mb-0">
                        <i class="bi bi-check-circle-fill" style="color: #628ECB;"></i>
                        <span class="ms-2">Verifikasi alergi obat sebelum menulis resep</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Profile Card -->
        <div class="card border-0 shadow-sm mb-3">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-person-badge-fill" style="color: #628ECB;"></i> Profil
                </h5>
            </div>
            <div class="card-body p-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center" style="width: 80px; height: 80px; background-color: rgba(98, 142, 203, 0.15);">
                        <i class="bi bi-person-fill" style="font-size: 2.5rem; color: #628ECB;"></i>
                    </div>
                </div>
                <h5 class="mb-1 fw-bold">{{ Auth::user()->nama_lengkap ?? 'dr. Dokter' }}</h5>
                <p class="text-muted small mb-3">Dokter Umum</p>
                <div class="d-grid gap-2">
                    <a href="{{ url('/dokter/profil') }}" class="btn btn-sm" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                        <i class="bi bi-gear"></i> Edit Profil
                    </a>
                </div>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-graph-up-arrow" style="color: #8AAEE0;"></i> Statistik
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                    <span class="text-muted small">Minggu Ini</span>
                    <span class="fw-semibold small" style="color: #628ECB;">{{ $pasienMingguIni ?? 5 }} Pasien</span>
                </div>
                <div class="d-flex justify-content-between mb-3 pb-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                    <span class="text-muted small">Bulan Ini</span>
                    <span class="fw-semibold small" style="color: #8AAEE0;">{{ $pasienBulanIni ?? 15 }} Pasien</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Total</span>
                    <span class="fw-semibold small" style="color: #B1C9EF;">{{ $totalRekamMedis ?? 1 }} Rekam Medis</span>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    :root {
        --primary-blue: #628ECB;
        --light-blue: #8AAEE0;
        --lighter-blue: #B1C9EF;
        --lightest-blue: #D5DEEF;
        --very-light-blue: #F0F3FA;
        --dark-blue: #395686;
    }

    /* Custom Gradient for Medical Theme */
    .bg-gradient-medical {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
    }

    /* Hover Effects */
    .hover-lift {
        transition: all 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(98, 142, 203, 0.2) !important;
    }

    .hover-shadow {
        transition: all 0.3s ease;
    }

    .hover-shadow:hover {
        box-shadow: 0 5px 15px rgba(98, 142, 203, 0.15);
        transform: translateY(-2px);
    }

    /* Card Border Hover */
    .card.border-2 {
        border-color: var(--primary-blue) !important;
        transition: all 0.3s ease;
    }

    .card.border-2:hover {
        border-color: var(--dark-blue) !important;
        box-shadow: 0 8px 20px rgba(98, 142, 203, 0.15) !important;
    }

    .bg-primary {
        background-color: var(--primary-blue) !important;
    }

    .text-primary {
        color: var(--primary-blue) !important;
    }

    .border-primary {
        border-color: var(--primary-blue) !important;
    }

    .btn-primary {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .btn-primary:hover {
        background-color: var(--dark-blue);
        border-color: var(--dark-blue);
    }

    .btn-outline-primary {
        color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    .btn-outline-primary:hover {
        background-color: var(--primary-blue);
        border-color: var(--primary-blue);
    }

    /* Smooth Animations */
    .card, .btn, a {
        transition: all 0.2s ease;
    }

    /* Card styling */
    .bg-opacity-10 {
        opacity: 0.1;
    }
</style>
@endpush