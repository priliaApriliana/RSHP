@extends('layouts.app')

@section('content')
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-hospital"></i> RSHP</h3>
    </div>

    <ul class="sidebar-menu">
        <li><a href="{{ route('resepsionis.dashboard') }}" class="menu-link active">
            <i class="fas fa-home"></i> Dashboard</a></li>

        <li><a href="{{ url('/admin/pet') }}" class="menu-link">
            <i class="fas fa-paw"></i> Pet</a></li>

        <li><a href="{{ url('/admin/pemilik') }}" class="menu-link">
            <i class="fas fa-users"></i> Pemilik</a></li>

        <li><a href="{{ url('/resepsionis/temudokter') }}" class="menu-link">
            <i class="fas fa-user-md"></i> Temu Dokter</a></li>

        <li><a href="{{ route('logout') }}" class="menu-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>

<div class="main-content" id="mainContent">
    <nav class="navbar-custom">
        <div class="d-flex justify-content-between align-items-center">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-profile">
                <span class="fw-semibold">Resepsionis</span>
                <div class="user-avatar">R</div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4">
        <h2 class="mb-4 fw-bold" style="color: var(--primary-blue);">Dashboard Resepsionis</h2>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-paw"></i></div>
                    <div class="stat-title">Total Pet</div>
                    <div class="stat-value">{{ $totalPet }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-users"></i></div>
                    <div class="stat-title">Total Pemilik</div>
                    <div class="stat-value">{{ $totalPemilik }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-user-md"></i></div>
                    <div class="stat-title">Total Temu Dokter</div>
                    <div class="stat-value">{{ $totalTemuDokter }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('asset/style/admin-dashboard.css') }}">
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endpush
