@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rekam Medis</li>
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

    /* Stats Cards */
    .stats-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .stats-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 30px rgba(98, 142, 203, 0.2) !important;
    }

    .stats-card-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
    }

    .stats-card-cyan {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
    }

    .stats-card-light {
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
    }

    .stats-card-info {
        background: linear-gradient(135deg, #D5DEEF 0%, #B1C9EF 100%);
    }

    .stats-icon {
        font-size: 3rem;
        opacity: 0.3;
    }

    /* Tab Navigation */
    .custom-tabs {
        border-bottom: 2px solid #D5DEEF;
        margin-bottom: 2rem;
    }

    .custom-tab {
        background: transparent;
        border: none;
        padding: 1rem 1.5rem;
        color: #6c757d;
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
        border-radius: 8px 8px 0 0;
    }

    .custom-tab:hover {
        color: var(--primary-blue);
        background-color: rgba(177, 201, 239, 0.1);
    }

    .custom-tab.active {
        color: var(--primary-blue);
        background-color: rgba(177, 201, 239, 0.15);
    }

    .custom-tab.active::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border-radius: 3px 3px 0 0;
    }

    .tab-badge {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
    }

    /* Content Cards */
    .content-card {
        border: none;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    }

    .card-header-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border: none;
        padding: 1.5rem;
    }

    .card-header-cyan {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        padding: 1.5rem;
    }

    /* List Items */
    .patient-item {
        border: none;
        border-bottom: 1px solid #D5DEEF;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }

    .patient-item:last-child {
        border-bottom: none;
    }

    .patient-item:hover {
        background-color: rgba(177, 201, 239, 0.08);
        transform: translateX(5px);
    }

    .patient-avatar {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s ease;
    }

    .patient-item:hover .patient-avatar {
        transform: scale(1.1) rotate(5deg);
    }

    .avatar-blue {
        background-color: rgba(98, 142, 203, 0.15);
    }

    .avatar-cyan {
        background-color: rgba(138, 174, 224, 0.15);
    }

    .number-badge {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
        padding: 0.35rem 0.75rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Buttons */
    .btn-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-blue:hover {
        background: linear-gradient(135deg, #395686 0%, #2a4066 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        color: white;
    }

    .btn-cyan {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-cyan:hover {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 174, 224, 0.3);
        color: white;
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 5rem;
        color: #B1C9EF;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    /* Alert */
    .alert-custom {
        border: none;
        border-radius: 10px;
        border-left: 4px solid var(--primary-blue);
        background-color: rgba(177, 201, 239, 0.1);
    }
</style>

@if(session('success'))
    <div class="alert alert-custom alert-dismissible fade show shadow-sm mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="bi bi-check-circle me-3" style="color: var(--primary-blue); font-size: 1.5rem;"></i>
            <span style="color: var(--dark-blue); font-weight: 500;">{{ session('success') }}</span>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Page Header -->
<div class="mb-4">
    <h3 class="fw-bold text-dark mb-1">
        <i class="bi bi-file-medical me-2" style="color: var(--primary-blue);"></i> 
        Rekam Medis Pasien
    </h3>
    <p class="text-muted mb-0">Kelola antrian dan riwayat pemeriksaan pasien</p>
</div>

<!-- Stats Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-blue shadow-sm h-100" onclick="showTab('antrian')">
            <div class="card-body d-flex align-items-center p-4">
                <div class="flex-grow-1">
                    <p class="text-white opacity-75 mb-2 fw-medium">Pasien Menunggu</p>
                    <h2 class="text-white fw-bold mb-0">{{ count($antrian) }}</h2>
                </div>
                <div class="text-end">
                    <i class="bi bi-clock stats-icon text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-cyan shadow-sm h-100" onclick="showTab('riwayat')">
            <div class="card-body d-flex align-items-center p-4">
                <div class="flex-grow-1">
                    <p class="text-white opacity-75 mb-2 fw-medium">Sudah Diperiksa</p>
                    <h2 class="text-white fw-bold mb-0">{{ count($rekamMedisSelesai) }}</h2>
                </div>
                <div class="text-end">
                    <i class="bi bi-check-circle stats-icon text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-light shadow-sm h-100">
            <div class="card-body d-flex align-items-center p-4">
                <div class="flex-grow-1">
                    <p class="text-dark opacity-75 mb-2 fw-medium">Total Pasien</p>
                    <h2 class="fw-bold mb-0" style="color: var(--dark-blue);">{{ count($antrian) + count($rekamMedisSelesai) }}</h2>
                </div>
                <div class="text-end">
                    <i class="bi bi-stethoscope stats-icon" style="color: var(--dark-blue);"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-3">
        <div class="card stats-card stats-card-info shadow-sm h-100">
            <div class="card-body d-flex align-items-center p-4">
                <div class="flex-grow-1">
                    <p class="text-dark opacity-75 mb-2 fw-medium">Persentase Selesai</p>
                    <h2 class="fw-bold mb-0" style="color: var(--dark-blue);">
                        {{ count($antrian) + count($rekamMedisSelesai) > 0 ? round((count($rekamMedisSelesai) / (count($antrian) + count($rekamMedisSelesai))) * 100, 1) : 0 }}%
                    </h2>
                </div>
                <div class="text-end">
                    <i class="bi bi-pie-chart stats-icon" style="color: var(--dark-blue);"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tab Navigation -->
<div class="custom-tabs">
    <div class="d-flex gap-2">
        <button class="custom-tab active" id="tab-antrian" onclick="showTab('antrian')" type="button">
            <i class="bi bi-people-cog me-2"></i> 
            Antrian Pemeriksaan
            <span class="tab-badge ms-2">{{ count($antrian) }}</span>
        </button>
        <button class="custom-tab" id="tab-riwayat" onclick="showTab('riwayat')" type="button">
            <i class="bi bi-clock-history me-2"></i> 
            Riwayat Pemeriksaan
            <span class="tab-badge ms-2">{{ count($rekamMedisSelesai) }}</span>
        </button>
    </div>
</div>

<!-- Tab Content -->
<div class="row">
    <!-- Antrian Pasien -->
    <div class="col-12" id="antrian-content">
        <div class="card content-card">
            <div class="card-header card-header-blue">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="text-white mb-1 fw-semibold">
                            <i class="bi bi-people-fill me-2"></i> Antrian Pemeriksaan
                        </h5>
                        <small class="text-white opacity-75">Pasien yang sedang menunggu pemeriksaan</small>
                    </div>
                    <span class="badge bg-white fs-6" style="color: var(--primary-blue);">{{ count($antrian) }} Pasien</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($antrian->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($antrian as $item)
                        <div class="list-group-item patient-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="patient-avatar avatar-blue">
                                        <i class="bi bi-paw fs-4" style="color: var(--primary-blue);"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="number-badge me-2">No. {{ $loop->iteration }}</span>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $item->nama ?? '-' }}</h6>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 text-muted small">
                                        <span>
                                            <i class="bi bi-layer-group me-1" style="color: var(--light-blue);"></i>
                                            {{ $item->nama_jenis_hewan ?? '-' }}
                                        </span>
                                        <span>
                                            <i class="bi bi-person me-1" style="color: var(--light-blue);"></i>
                                            {{ $item->nama_pemilik ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 ms-3">
                                    <a href="{{ route('dokter.rekammedis.create', ['idreservasi_dokter' => $item->idreservasi_dokter]) }}" 
                                       class="btn btn-blue">
                                        <i class="bi bi-stethoscope me-2"></i> Periksa
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-state-icon d-block"></i>
                        <h5 class="fw-bold mb-2" style="color: var(--dark-blue);">Tidak Ada Antrian</h5>
                        <p class="text-muted mb-0">Saat ini tidak ada pasien yang menunggu pemeriksaan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Rekam Medis Selesai -->
    <div class="col-12" id="riwayat-content" style="display: none;">
        <div class="card content-card">
            <div class="card-header card-header-cyan">
                <div class="d-flex align-items-center justify-content-between">
                    <div>
                        <h5 class="text-white mb-1 fw-semibold">
                            <i class="bi bi-clock-history me-2"></i> Riwayat Pemeriksaan
                        </h5>
                        <small class="text-white opacity-75">Rekam medis yang telah selesai diperiksa</small>
                    </div>
                    <span class="badge bg-white fs-6" style="color: var(--primary-blue);">{{ count($rekamMedisSelesai) }} Rekam Medis</span>
                </div>
            </div>
            <div class="card-body p-0">
                @if($rekamMedisSelesai->count() > 0)
                    <div class="list-group list-group-flush">
                        @foreach($rekamMedisSelesai as $rm)
                        <div class="list-group-item patient-item">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 me-3">
                                    <div class="patient-avatar avatar-cyan">
                                        <i class="bi bi-file-medical fs-4" style="color: var(--light-blue);"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="number-badge me-2">No. {{ $loop->iteration }}</span>
                                        <h6 class="mb-0 fw-bold text-dark">{{ $rm->nama ?? '-' }}</h6>
                                    </div>
                                    <div class="d-flex flex-wrap gap-3 text-muted small">
                                        <span>
                                            <i class="bi bi-calendar3 me-1" style="color: var(--light-blue);"></i>
                                            {{ \Carbon\Carbon::parse($rm->created_at)->format('d M Y, H:i') }}
                                        </span>
                                        <span>
                                            <i class="bi bi-person me-1" style="color: var(--light-blue);"></i>
                                            {{ $rm->nama_pemilik ?? '-' }}
                                        </span>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 ms-3">
                                    <a href="{{ route('dokter.rekammedis.show', $rm->idrekam_medis) }}" 
                                       class="btn btn-cyan">
                                        <i class="bi bi-eye me-2"></i> Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <i class="bi bi-inbox empty-state-icon d-block"></i>
                        <h5 class="fw-bold mb-2" style="color: var(--dark-blue);">Belum Ada Riwayat</h5>
                        <p class="text-muted mb-0">Belum ada rekam medis yang telah selesai diperiksa</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function showTab(tab) {
        const antrianContent = document.getElementById('antrian-content');
        const riwayatContent = document.getElementById('riwayat-content');
        const tabAntrian = document.getElementById('tab-antrian');
        const tabRiwayat = document.getElementById('tab-riwayat');

        if (tab === 'antrian') {
            antrianContent.style.display = 'block';
            riwayatContent.style.display = 'none';
            tabAntrian.classList.add('active');
            tabRiwayat.classList.remove('active');
        } else if (tab === 'riwayat') {
            antrianContent.style.display = 'none';
            riwayatContent.style.display = 'block';
            tabAntrian.classList.remove('active');
            tabRiwayat.classList.add('active');
        }
    }

    // Auto hide alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.querySelector('.alert-custom');
        if (alert) {
            setTimeout(function() {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            }, 5000);
        }
    });
</script>

@endsection