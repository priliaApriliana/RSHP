@extends('layouts.lte.main')

@section('page-title', 'Dashboard Resepsionis')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Home</a></li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<!-- Welcome Card -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card bg-gradient-primary text-white shadow-lg border-0">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h4 class="mb-2 fw-bold">
                            <i class="bi bi-emoji-smile"></i> Selamat Datang, Resepsionis!
                        </h4>
                        <p class="mb-0 opacity-75">
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

<!-- Statistics Cards -->
<div class="row g-3 mb-4">
    <!-- Card Total Pet -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="bi bi-heart-fill text-primary" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Total Pet</div>
                        <h2 class="mb-0 fw-bold">{{ $totalPet }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ url('/admin/pet') }}" class="text-decoration-none small">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Pemilik -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="bi bi-people-fill text-success" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Total Pemilik</div>
                        <h2 class="mb-0 fw-bold">{{ $totalPemilik }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ url('/admin/pemilik') }}" class="text-decoration-none small">
                        Lihat Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Total Temu Dokter -->
    <div class="col-lg-4 col-md-6">
        <div class="card border-0 shadow-sm hover-lift">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="bi bi-calendar-check-fill text-info" style="font-size: 2rem;"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <div class="text-muted small mb-1">Total Temu Dokter</div>
                        <h2 class="mb-0 fw-bold">{{ $totalTemuDokter }}</h2>
                    </div>
                </div>
                <div class="mt-3 pt-3 border-top">
                    <a href="{{ url('/resepsionis/temudokter') }}" class="text-decoration-none small">
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
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-lightning-charge-fill text-warning"></i> Quick Actions
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/admin/pet') }}" class="text-decoration-none">
                            <div class="card border-2 border-primary h-100 hover-shadow">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-plus-circle-fill text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Registrasi Pet</h6>
                                    <p class="text-muted small mb-0">Daftarkan pet baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/admin/pemilik') }}" class="text-decoration-none">
                            <div class="card border-2 border-success h-100 hover-shadow">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-person-plus-fill text-success" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Registrasi Pemilik</h6>
                                    <p class="text-muted small mb-0">Daftarkan pemilik baru</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/resepsionis/temudokter') }}" class="text-decoration-none">
                            <div class="card border-2 border-info h-100 hover-shadow">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-plus-fill text-info" style="font-size: 3rem;"></i>
                                    </div>
                                    <h6 class="fw-semibold text-dark mb-2">Buat Jadwal</h6>
                                    <p class="text-muted small mb-0">Jadwalkan temu dokter</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-3 col-sm-6">
                        <a href="{{ url('/resepsionis/temudokter') }}" class="text-decoration-none">
                            <div class="card border-2 border-warning h-100 hover-shadow">
                                <div class="card-body text-center p-4">
                                    <div class="mb-3">
                                        <i class="bi bi-calendar-event-fill text-warning" style="font-size: 3rem;"></i>
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
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-info-circle-fill text-primary"></i> Informasi
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="alert alert-primary border-0 mb-3" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-lightbulb-fill fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="alert-heading fw-bold mb-2">Tips Pelayanan</h6>
                            <p class="mb-0 small">
                                Pastikan data pemilik dan pet sudah lengkap sebelum membuat jadwal temu dokter.
                                Verifikasi nomor telepon untuk konfirmasi jadwal.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-success border-0 mb-0" role="alert">
                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <i class="bi bi-check-circle-fill fs-4"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="alert-heading fw-bold mb-2">Reminder</h6>
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
            <div class="card-header bg-white border-0 py-3">
                <h5 class="card-title mb-0 fw-bold">
                    <i class="bi bi-clock-fill text-success"></i> Jam Operasional
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Senin - Jumat</span>
                    <span class="fw-semibold small">08:00 - 20:00</span>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted small">Sabtu</span>
                    <span class="fw-semibold small">08:00 - 16:00</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span class="text-muted small">Minggu</span>
                    <span class="fw-semibold small text-danger">Tutup</span>
                </div>
                
                <hr class="my-3">
                
                <div class="text-center">
                    <small class="text-muted">
                        <i class="bi bi-telephone-fill"></i> Hotline: (021) 1234-5678
                    </small>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
/* Custom Gradient */
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Hover Effects */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.hover-shadow {
    transition: all 0.3s ease;
}

.hover-shadow:hover {
    box-shadow: 0 5px 15px rgba(0,0,0,0.15);
    transform: translateY(-2px);
}

/* Card Border Hover */
.card.border-2:hover {
    border-color: currentColor !important;
}

/* Smooth Animations */
* {
    transition: all 0.2s ease;
}
</style>
@endpush