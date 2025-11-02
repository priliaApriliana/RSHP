@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-user-md"></i> Dashboard Dokter
        </h3>

        <!-- STATISTICS -->
        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-notes-medical"></i>
                    </div>
                    <div class="stat-title">Total Rekam Medis</div>
                    <div class="stat-value">{{ $totalRekamMedis ?? 0 }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-title">Rekam Medis Hari Ini</div>
                    <div class="stat-value">{{ $rekamMedisHariIni ?? 0 }}</div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-title">Pasien Terdaftar</div>
                    <div class="stat-value">{{ $totalPasien ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-actions">
            <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            <a href="{{ url('/dokter/rekammedis') }}" class="action-btn">
                <i class="fas fa-file-medical"></i> Lihat Rekam Medis
            </a>
            <a href="{{ url('/dokter/jadwal') }}" class="action-btn">
                <i class="fas fa-calendar-alt"></i> Jadwal Praktik
            </a>
        </div>
    </div>
</div>
@endsection