@extends('layouts.lte.main')

@section('page-title', 'Dashboard Pemilik')

@section('content')

<style>
    /* Pastikan styling inline untuk override */
    .welcome-banner {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%) !important;
        border-radius: 15px !important;
        color: white !important;
        padding: 2rem !important;
        margin-bottom: 2rem !important;
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.3) !important;
    }
    
    .welcome-banner h2 {
        font-size: 28px !important;
        font-weight: 700 !important;
        margin-bottom: 0.5rem !important;
        color: white !important;
    }
    
    .welcome-banner p {
        opacity: 0.9 !important;
        margin-bottom: 0 !important;
        color: white !important;
    }
    
    .stat-card {
        background: white !important;
        border-radius: 12px !important;
        padding: 1.5rem !important;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08) !important;
        transition: all 0.3s ease !important;
        border-left: 4px solid #8AAEE0 !important;
        height: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-5px) !important;
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.15) !important;
    }
    
    .stat-icon {
        width: 60px !important;
        height: 60px !important;
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%) !important;
        border-radius: 12px !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 28px !important;
        color: white !important;
        margin-bottom: 1rem !important;
    }
    
    .stat-title {
        font-size: 14px !important;
        color: #628ECB !important;
        margin-bottom: 0.5rem !important;
        font-weight: 500 !important;
    }
    
    .stat-value {
        font-size: 32px !important;
        font-weight: 700 !important;
        color: #395886 !important;
    }
    
    .info-card {
        background: #F0F3FA !important;
        border-radius: 12px !important;
        padding: 1.5rem !important;
        border: 2px solid #D5DEEF !important;
    }
    
    .info-card h5 {
        color: #395886 !important;
        font-weight: 600 !important;
        margin-bottom: 1rem !important;
    }
    
    .info-card p {
        color: #628ECB !important;
        margin-bottom: 0.5rem !important;
    }
    
    .quick-actions {
        display: grid !important;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)) !important;
        gap: 1rem !important;
        margin-top: 2rem !important;
    }
    
    .action-btn {
        background: white !important;
        border: 2px solid #D5DEEF !important;
        border-radius: 12px !important;
        padding: 1.5rem !important;
        text-align: center !important;
        text-decoration: none !important;
        color: #395886 !important;
        transition: all 0.3s ease !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        gap: 0.5rem !important;
    }
    
    .action-btn:hover {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%) !important;
        color: white !important;
        transform: translateY(-3px) !important;
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.3) !important;
        border-color: #628ECB !important;
        text-decoration: none !important;
    }
    
    .action-btn i {
        font-size: 36px !important;
    }
    
    .action-btn span {
        font-weight: 600 !important;
        font-size: 14px !important;
    }
    
    .section-title {
        color: #395886 !important;
        font-weight: 600 !important;
        margin-bottom: 1rem !important;
    }
</style>

<!-- Welcome Banner -->
<div class="welcome-banner">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="bi bi-person-circle"></i> Selamat Datang, {{ Auth::user()->nama }}!</h2>
            <p>Kelola informasi hewan peliharaan dan riwayat kesehatan mereka dengan mudah</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <i class="bi bi-heart-fill" style="font-size: 80px; opacity: 0.3;"></i>
        </div>
    </div>
</div>

<!-- Statistics -->
<div class="row mb-4">
    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-heart-fill"></i>
            </div>
            <div class="stat-title">Total Hewan Peliharaan</div>
            <div class="stat-value">{{ $totalPet }}</div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-calendar-check-fill"></i>
            </div>
            <div class="stat-title">Total Kunjungan</div>
            <div class="stat-value">{{ $totalTemuDokter }}</div>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 mb-3">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clock-fill"></i>
            </div>
            <div class="stat-title">Janji Temu Pending</div>
            <div class="stat-value">{{ $temuDokterPending }}</div>
        </div>
    </div>
</div>

<!-- Info Akun -->
<div class="row mb-4">
    <div class="col-12">
        <div class="info-card">
            <h5><i class="bi bi-person-badge-fill"></i> Informasi Akun</h5>
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
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-12">
        <h5 class="section-title">
            <i class="bi bi-lightning-charge-fill"></i> Menu Cepat
        </h5>
        <div class="quick-actions">
            <a href="{{ route('pemilik.pet') }}" class="action-btn">
                <i class="bi bi-heart-fill"></i>
                <span>Hewan Saya</span>
            </a>
            <a href="{{ route('pemilik.temu-dokter') }}" class="action-btn">
                <i class="bi bi-calendar-event-fill"></i>
                <span>Jadwal Temu Dokter</span>
            </a>
            <a href="{{ route('pemilik.riwayat') }}" class="action-btn">
                <i class="bi bi-file-earmark-medical-fill"></i>
                <span>Riwayat Pemeriksaan</span>
            </a>
        </div>
    </div>
</div>

@endsection