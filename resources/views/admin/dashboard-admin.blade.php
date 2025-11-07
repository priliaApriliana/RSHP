@extends('layouts.admin')

@section('content')

<!-- SIDEBAR -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-hospital"></i> RSHP</h3>
    </div>
    
    <ul class="sidebar-menu">
        <li class="menu-item">
            <a href="{{ url('/admin/dashboard') }}" class="menu-link active">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/pet') }}" class="menu-link">
                <i class="fas fa-paw"></i>
                <span>Data Pet</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/jenishewan') }}" class="menu-link">
                <i class="fas fa-cat"></i>
                <span>Jenis Hewan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/rashewan') }}" class="menu-link">
                <i class="fas fa-dog"></i>
                <span>Ras Hewan</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/kategori') }}" class="menu-link">
                <i class="fas fa-tags"></i>
                <span>Kategori</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/role') }}" class="menu-link">
                <i class="fas fa-user-shield"></i>
                <span>Role</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/pemilik') }}" class="menu-link">
                <i class="fas fa-users"></i>
                <span>Pemilik</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/user') }}" class="menu-link">
                <i class="fas fa-user-md"></i>
                <span>Data User</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/kategoriklinis') }}" class="menu-link">
                <i class="fas fa-briefcase-medical"></i>
                <span>Kategori Klinis</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ url('/admin/kodetindakanterapi') }}" class="menu-link">
                <i class="fas fa-file-alt"></i>
                <span>kode Tindakan Terapi</span>
            </a>
        </li>
        <li class="menu-item">
            <a href="{{ route('logout') }}"
            class="menu-link"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>

            </a>
        </li>
    </ul>
</div>

<!-- MAIN CONTENT -->
<div class="main-content" id="mainContent">
    <!-- NAVBAR -->
    <nav class="navbar-custom">
        <div class="d-flex justify-content-between align-items-center">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="user-profile">
                <span class="fw-semibold">Admin</span>
                <div class="user-avatar">A</div>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    <div class="container-fluid px-4">
        <h2 class="mb-4 fw-bold" style="color: var(--primary-blue);">Dashboard Admin</h2>
        
        <!-- STATISTICS -->
        <div class="row g-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-paw"></i>
                    </div>
                    <div class="stat-title">Total Pet</div>
                    <div class="stat-value">{{ $totalPet ?? 0 }}</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-title">Total Pemilik</div>
                    <div class="stat-value">{{ $totalPemilik ?? 0 }}</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <div class="stat-title">Total Dokter</div>
                    <div class="stat-value">{{ $totalDokter ?? 0 }}</div>
                </div>
            </div>
            
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="stat-title">Layanan Hari Ini</div>
                    <div class="stat-value">{{ $layananHariIni ?? 0 }}</div>
                </div>
            </div>
        </div>

        <!-- QUICK ACTIONS -->
        <div class="quick-actions">
            <h5><i class="fas fa-bolt me-2"></i>Quick Actions</h5>
            <a href="{{ url('/admin/pet/create') }}" class="action-btn">
                <i class="fas fa-plus-circle"></i> Tambah Pet
            </a>
            <a href="{{ url('/admin/layanan/create') }}" class="action-btn">
                <i class="fas fa-calendar-plus"></i> Jadwal Layanan
            </a>
            <a href="{{ url('/admin/laporan') }}" class="action-btn">
                <i class="fas fa-file-download"></i> Cetak Laporan
            </a>
        </div>

        <!-- CHARTS -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="chart-card">
                    <h5><i class="fas fa-chart-line me-2"></i>Statistik Layanan Bulanan</h5>
                    <canvas id="layananChart" height="80"></canvas>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="chart-card">
                    <h5><i class="fas fa-chart-pie me-2"></i>Jenis Hewan</h5>
                    <canvas id="jenisHewanChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin-dashboard.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endpush