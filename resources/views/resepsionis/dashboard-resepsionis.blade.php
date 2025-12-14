@extends('layouts.lte.main')

@section('page-title', 'Dashboard Resepsionis')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
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
    
    .welcome-card-resep {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%) !important;
        color: white;
    }
</style>

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card welcome-card-resep shadow-lg border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-2 fw-bold">
                            <i class="bi bi-emoji-smile"></i> Selamat Datang, {{ $user->nama ?? 'Resepsionis' }}!
                        </h4>
                        <p class="mb-0" style="opacity: 0.9;">
                            Kelola registrasi pasien dan jadwal temu dokter dengan mudah
                        </p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="bi bi-hospital" style="font-size: 4rem; opacity: 0.3;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Status & Quick Info -->
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted small fw-bold mb-2">STATUS HARI INI</h6>
                        <h3 class="mb-0 fw-bold" style="color: #628ECB;">
                            <i class="bi bi-check-circle-fill"></i> Siap Melayani
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top" style="border-top-color: #D5DEEF;"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted small fw-bold mb-2">JADWAL HARI INI</h6>
                        <h3 class="mb-0 fw-bold" style="color: #8AAEE0;">{{ $totalTemuDokter }} Appointment</h3>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top" style="border-top-color: #D5DEEF;"></div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h6 class="text-muted small fw-bold mb-2">TERAKHIR LOGIN</h6>
                        <h3 class="mb-0 fw-bold" style="color: #B1C9EF; font-size: 0.9rem;">
                            <i class="bi bi-clock-history"></i> Sekarang
                        </h3>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white border-top" style="border-top-color: #D5DEEF;"></div>
        </div>
    </div>
</div>

<!-- Profile & Statistics Row -->
<div class="row mb-4">
    <!-- Profile Card -->
    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4 text-center">
                <div class="mb-3">
                    <div class="rounded-circle d-inline-flex align-items-center justify-content-center p-4" style="background-color: rgba(98, 142, 203, 0.15);">
                        <i class="bi bi-person-circle" style="font-size: 3rem; color: #628ECB;"></i>
                    </div>
                </div>
                <h5 class="fw-bold mb-1">{{ $user->nama ?? 'Resepsionis' }}</h5>
                <p class="text-muted small mb-3">Resepsionis</p>
                <div class="border-top pt-3" style="border-top-color: #D5DEEF;">
                    <div class="text-start">
                        <p class="mb-2 small">
                            <strong style="color: #628ECB;">Email:</strong><br>
                            <span class="text-muted">{{ $user->email ?? '-' }}</span>
                        </p>
                        <p class="mb-0 small">
                            <strong style="color: #628ECB;">No. Telepon:</strong><br>
                            <span class="text-muted">{{ $user->no_wa ?? '-' }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="col-lg-8">
        <div class="row g-3">
            <!-- Card Total Pet -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle p-3" style="background-color: rgba(98, 142, 203, 0.15);">
                                    <i class="bi bi-heart-fill" style="font-size: 2rem; color: #628ECB;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="text-muted small mb-1">Total Pet</div>
                                <h2 class="mb-0 fw-bold" style="color: #628ECB;">{{ $totalPet }}</h2>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-top" style="border-top-color: #D5DEEF;">
                            <a href="{{ route('resepsionis.pet.index') }}" class="text-decoration-none small" style="color: #628ECB;">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Pemilik -->
            <div class="col-md-6">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle p-3" style="background-color: rgba(138, 174, 224, 0.2);">
                                    <i class="bi bi-people-fill" style="font-size: 2rem; color: #8AAEE0;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="text-muted small mb-1">Total Pemilik</div>
                                <h2 class="mb-0 fw-bold" style="color: #8AAEE0;">{{ $totalPemilik }}</h2>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-top" style="border-top-color: #D5DEEF;">
                            <a href="{{ route('resepsionis.pemilik.index') }}" class="text-decoration-none small" style="color: #8AAEE0;">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Total Temu Dokter -->
            <div class="col-md-12">
                <div class="card border-0 shadow-sm hover-lift">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="rounded-circle p-3" style="background-color: rgba(177, 201, 239, 0.25);">
                                    <i class="bi bi-calendar-check-fill" style="font-size: 2rem; color: #B1C9EF;"></i>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <div class="text-muted small mb-1">Total Temu Dokter</div>
                                <h2 class="mb-0 fw-bold" style="color: #B1C9EF;">{{ $totalTemuDokter }}</h2>
                            </div>
                        </div>
                        <div class="mt-3 pt-3 border-top" style="border-top-color: #D5DEEF;">
                            <a href="{{ route('resepsionis.temudokter.index') }}" class="text-decoration-none small" style="color: #B1C9EF;">
                                Lihat Detail <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                    </div>
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
                        <a href="{{ route('resepsionis.pet.create') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #628ECB;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-plus-circle-fill" style="font-size: 3rem; color: #628ECB;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Registrasi Pet</h6>
                                    <p class="text-muted small mb-0">Daftarkan pet baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('resepsionis.pemilik.create') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #8AAEE0;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-person-plus-fill" style="font-size: 3rem; color: #8AAEE0;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Registrasi Pemilik</h6>
                                    <p class="text-muted small mb-0">Daftarkan pemilik baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('resepsionis.temudokter.create') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #B1C9EF;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-plus-fill" style="font-size: 3rem; color: #B1C9EF;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Buat Jadwal</h6>
                                    <p class="text-muted small mb-0">Jadwalkan temu dokter</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ route('resepsionis.temudokter.index') }}" class="text-decoration-none">
                            <div class="card border-2 h-100 hover-shadow" style="border-color: #D5DEEF;">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-event-fill" style="font-size: 3rem; color: #D5DEEF;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Lihat Jadwal</h6>
                                    <p class="text-muted small mb-0">Cek jadwal hari ini</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Information Cards -->
<div class="row g-3">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-info-circle-fill" style="color: #628ECB;"></i> Informasi
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="border-0 mb-3 p-3 rounded" style="background-color: rgba(98, 142, 203, 0.1); border-left: 4px solid #628ECB;">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-lightbulb-fill fs-4" style="color: #628ECB;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-2" style="color: #628ECB;">Tips Pelayanan</h6>
                            <p class="mb-0 small">
                                Pastikan data pemilik dan pet sudah lengkap sebelum membuat jadwal temu dokter.
                                Verifikasi nomor telepon untuk konfirmasi jadwal.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="border-0 p-3 rounded" style="background-color: rgba(138, 174, 224, 0.1); border-left: 4px solid #8AAEE0;">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill fs-4" style="color: #8AAEE0;"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="fw-bold mb-2" style="color: #8AAEE0;">Reminder</h6>
                            <p class="mb-0 small">
                                Jangan lupa untuk mengkonfirmasi jadwal temu dokter H-1 kepada pemilik pet.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white border-0 py-3 border-bottom" style="border-bottom-color: #D5DEEF;">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-clock-fill" style="color: #B1C9EF;"></i> Jam Operasional
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Senin - Jumat</span>
                    <span class="fw-semibold small" style="color: #628ECB;">08:00 - 20:00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Sabtu</span>
                    <span class="fw-semibold small" style="color: #8AAEE0;">08:00 - 16:00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Minggu</span>
                    <span class="fw-semibold small" style="color: #B1C9EF;">Tutup</span>
                </div>
                
                <hr class="my-3" style="border-color: #D5DEEF;">
                
                <div class="text-center">
                    <small class="text-muted">
                        <i class="bi bi-telephone-fill" style="color: #628ECB;"></i> Hotline: (021) 1234-5678
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
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

/* Smooth Animations */
.card, .btn, a {
    transition: all 0.2s ease;
}
</style>
@endpush
