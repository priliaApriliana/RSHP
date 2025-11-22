@extends('layouts.lte.main')

@section('page-title', 'Dashboard Pemilik')
@section('content')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-user"></i> Dashboard Pemilik
        </h3>

        <!-- Informasi Pemilik -->
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title"><i class="fas fa-user-circle"></i> Informasi Akun</h5>
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>Nama:</strong> {{ Auth::user()->nama }}</p>
                        <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    </div>
                    <div class="col-md-6">
                        <p><strong>No. WhatsApp:</strong> {{ $pemilik->no_wa ?? '-' }}</p>
                        <p><strong>Alamat:</strong> {{ $pemilik->alamat ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- STATISTICS -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div class="stat-title">Total Hewan Peliharaan</div>
                    <div class="stat-value">{{ $totalPet }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-title">Total Kunjungan</div>
                    <div class="stat-value">{{ $totalTemuDokter }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-title">Janji Temu Pending</div>
                    <div class="stat-value">{{ $temuDokterPending }}</div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-actions">
            <h5><i class="fas fa-bolt me-2"></i>Menu Cepat</h5>
            <a href="{{ route('pemilik.pet') }}" class="action-btn">
                <i class="fas fa-paw"></i> Lihat Hewan Saya
            </a>
            <a href="{{ route('pemilik.riwayat') }}" class="action-btn">
                <i class="fas fa-history"></i> Riwayat Pemeriksaan
            </a>
        </div>
    </div>
</div>
@endsection