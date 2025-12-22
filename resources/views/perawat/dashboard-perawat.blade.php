@extends('layouts.lte.main')

@section('page-title', 'Dashboard Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('styles')
<style>
:root {
    --primary: #628ECB;
    --primary-dark: #395886;
    --primary-light: #8AAEE0;
    --secondary: #B1C9EF;
    --bg-light: #F0F4FA;
    --text-dark: #2C3E50;
    --shadow: rgba(98, 142, 203, 0.15);
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: var(--bg-light);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* ============ STATS CARDS ============ */
.stats-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 24px;
    margin-bottom: 32px;
}

.stat-card {
    background: white;
    border-radius: 20px;
    padding: 28px;
    box-shadow: 0 8px 24px var(--shadow);
    position: relative;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 5px;
    background: linear-gradient(90deg, var(--primary), var(--primary-light));
}

.stat-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 32px rgba(98, 142, 203, 0.25);
}

.stat-card-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 20px;
}

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    color: white;
    box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
}

.stat-trend {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
    background: rgba(34, 197, 94, 0.1);
    color: #16a34a;
}

.stat-content h3 {
    font-size: 42px;
    font-weight: 800;
    color: var(--text-dark);
    margin-bottom: 8px;
    line-height: 1;
}

.stat-content p {
    color: #64748b;
    font-size: 15px;
    font-weight: 500;
    margin: 0;
}

.stat-footer {
    margin-top: 20px;
    padding-top: 16px;
    border-top: 2px solid #f1f5f9;
}

.stat-footer a {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: gap 0.3s;
}

.stat-footer a:hover {
    gap: 10px;
}

/* ============ QUICK ACTIONS ============ */
.quick-actions {
    background: white;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 8px 24px var(--shadow);
    margin-bottom: 32px;
}

.section-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 24px;
}

.section-icon {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    color: white;
    font-size: 22px;
}

.section-header h2 {
    font-size: 24px;
    font-weight: 700;
    color: var(--text-dark);
    margin: 0;
}

.actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 16px;
}

.action-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    padding: 20px;
    border-radius: 16px;
    border: 2px solid #e2e8f0;
    background: white;
    color: var(--text-dark);
    text-decoration: none;
    font-weight: 600;
    font-size: 15px;
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.action-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(98, 142, 203, 0.1), transparent);
    transition: left 0.5s;
}

.action-btn:hover::before {
    left: 100%;
}

.action-btn:hover {
    border-color: var(--primary);
    color: var(--primary);
    transform: translateY(-2px);
    box-shadow: 0 8px 16px var(--shadow);
}

.action-btn i {
    font-size: 20px;
}

/* ============ RECENT ACTIVITY ============ */
.recent-activity {
    background: white;
    border-radius: 20px;
    padding: 32px;
    box-shadow: 0 8px 24px var(--shadow);
}

.activity-list {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.activity-item {
    display: flex;
    align-items: center;
    gap: 16px;
    padding: 16px;
    border-radius: 12px;
    background: #f8fafc;
    transition: all 0.3s;
}

.activity-item:hover {
    background: #f1f5f9;
    transform: translateX(4px);
}

.activity-avatar {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: linear-gradient(135deg, var(--primary-light), var(--primary));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 18px;
    flex-shrink: 0;
}

.activity-content {
    flex: 1;
}

.activity-title {
    font-weight: 600;
    color: var(--text-dark);
    margin-bottom: 4px;
    font-size: 15px;
}

.activity-meta {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 13px;
    color: #64748b;
}

.activity-meta span {
    display: flex;
    align-items: center;
    gap: 4px;
}

.empty-state {
    text-align: center;
    padding: 48px 24px;
}

.empty-state-icon {
    font-size: 64px;
    color: #cbd5e1;
    margin-bottom: 16px;
}

.empty-state h3 {
    font-size: 18px;
    color: var(--text-dark);
    margin-bottom: 8px;
}

.empty-state p {
    color: #64748b;
    font-size: 14px;
}

/* ============ RESPONSIVE ============ */
@media (max-width: 768px) {
    .stats-container {
        grid-template-columns: 1fr;
    }
    
    .actions-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-card {
        padding: 20px;
    }
    
    .quick-actions,
    .recent-activity {
        padding: 24px;
    }
}
</style>
@endsection

@section('content')

{{-- STATISTICS CARDS --}}
<div class="stats-container">
    {{-- Total Pasien --}}
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon">
                <i class="bi bi-bug"></i>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up"></i>
                <span>+12%</span>
            </div>
        </div>
        <div class="stat-content">
            <h3>{{ $totalPasien }}</h3>
            <p>Total Pasien Terdaftar</p>
        </div>
        <div class="stat-footer">
            <a href="{{ route('perawat.pasien.index') }}">
                Lihat Detail
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Total Rekam Medis --}}
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon">
                <i class="bi bi-file-medical"></i>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up"></i>
                <span>+8%</span>
            </div>
        </div>
        <div class="stat-content">
            <h3>{{ $totalRekamMedis }}</h3>
            <p>Total Rekam Medis</p>
        </div>
        <div class="stat-footer">
            <a href="{{ route('perawat.rekammedis.index') }}">
                Lihat Detail
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Rekam Medis Bulan Ini --}}
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up"></i>
                <span>+15%</span>
            </div>
        </div>
        <div class="stat-content">
            <h3>{{ $rekamMedisBulanIni }}</h3>
            <p>Rekam Medis Bulan Ini</p>
        </div>
        <div class="stat-footer">
            <a href="{{ route('perawat.rekammedis.index') }}">
                Lihat Detail
                <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- Pasien Aktif --}}
    <div class="stat-card">
        <div class="stat-card-header">
            <div class="stat-icon">
                <i class="bi bi-person-circle"></i>
            </div>
            <div class="stat-trend">
                <i class="bi bi-arrow-up"></i>
                <span>+5%</span>
            </div>
        </div>
        <div class="stat-content">
            <h3>{{ $pasienAktifBulanIni }}</h3>
            <p>Pasien Aktif Bulan Ini</p>
        </div>
        <div class="stat-footer">
            <a href="{{ route('perawat.pasien.index') }}">
                Lihat Detail
                <i class="bi bi-group-person"></i>
            </a>
        </div>
    </div>
</div>

{{-- QUICK ACTIONS --}}
<div class="quick-actions">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-lightning"></i>
        </div>
        <h2>Aksi Cepat</h2>
    </div>
    <div class="actions-grid">
        <a href="{{ route('perawat.rekammedis.create') }}" class="action-btn">
            <i class="bi bi-plus-circle"></i>
            <span>Tambah Rekam Medis</span>
        </a>
        <a href="{{ route('perawat.pasien.index') }}" class="action-btn">
            <i class="bi bi-search"></i>
            <span>Cari Data Pasien</span>
        </a>
        <a href="{{ route('perawat.rekammedis.index') }}" class="action-btn">
            <i class="bi bi-clipboard"></i>
            <span>Daftar Rekam Medis</span>
        </a>
        <a href="{{ route('perawat.profil') }}" class="action-btn">
            <i class="bi bi-person-circle"></i>
            <span>Kelola Profil</span>
        </a>
    </div>
</div>

{{-- RECENT ACTIVITY --}}
<div class="recent-activity">
    <div class="section-header">
        <div class="section-icon">
            <i class="bi bi-clock"></i>
        </div>
        <h2>Aktivitas Terbaru</h2>
    </div>
    
    @if($rekamMedisTerbaru->count() > 0)
        <div class="activity-list">
            @foreach($rekamMedisTerbaru as $rm)
                <div class="activity-item">
                    <div class="activity-avatar">
                        {{ strtoupper(substr($rm->nama_pet, 0, 2)) }}
                    </div>
                    <div class="activity-content">
                        <div class="activity-title">
                            Pemeriksaan {{ $rm->nama_pet }}
                        </div>
                        <div class="activity-meta">
                            <span>
                                <i class="bi bi-person"></i>
                                {{ $rm->nama_pemilik }}
                            </span>
                            <span>
                                <i class="bi bi-person-badge"></i>
                                {{ $rm->nama_dokter ?? 'Belum ditentukan' }}
                            </span>
                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $rm->waktu_daftar ? \Carbon\Carbon::parse($rm->waktu_daftar)->format('d M Y') : \Carbon\Carbon::parse($rm->created_at)->format('d M Y') }}
                            </span>
                        </div>
                    </div>
                    <a href="{{ route('perawat.rekammedis.index') }}" class="action-btn" style="padding: 10px 16px; font-size: 13px;">
                        <i class="bi bi-eye"></i>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-inbox"></i>
            </div>
            <h3>Belum Ada Aktivitas</h3>
            <p>Belum ada rekam medis yang tercatat dalam sistem</p>
        </div>
    @endif
</div>

@endsection