@extends('layouts.lte.main')

@section('page-title', 'Dashboard Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <!-- Total Pasien -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalPasien }}</h3>
                <p>Total Pasien</p>
            </div>
            <div class="icon">
                <i class="fas fa-paw"></i>
            </div>
            <a href="{{ route('perawat.pasien.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Total Rekam Medis -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $totalRekamMedis }}</h3>
                <p>Total Rekam Medis</p>
            </div>
            <div class="icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <a href="{{ route('perawat.rekammedis.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>

    <!-- Rekam Medis Bulan Ini -->
    <div class="col-lg-4 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $rekamMedisBulanIni }}</h3>
                <p>Rekam Medis Bulan Ini</p>
            </div>
            <div class="icon">
                <i class="fas fa-calendar-alt"></i>
            </div>
            <a href="{{ route('perawat.rekammedis.index') }}" class="small-box-footer">
                Lihat Detail <i class="fas fa-arrow-circle-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt"></i> Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <a href="{{ route('perawat.rekammedis.create') }}" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-plus"></i> Tambah Rekam Medis
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('perawat.pasien.index') }}" class="btn btn-info btn-block btn-lg">
                            <i class="fas fa-search"></i> Lihat Data Pasien
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-success btn-block btn-lg">
                            <i class="fas fa-list"></i> Daftar Rekam Medis
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('perawat.profil') }}" class="btn btn-secondary btn-block btn-lg">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Info Section -->
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi</h3>
            </div>
            <div class="card-body">
                <p>Selamat datang di Dashboard Perawat Rumah Sakit Hewan!</p>
                <p>Gunakan menu di sebelah kiri untuk mengakses fitur-fitur yang tersedia:</p>
                <ul>
                    <li><strong>Data Pasien:</strong> Lihat dan cari informasi pasien hewan</li>
                    <li><strong>Rekam Medis:</strong> Kelola rekam medis pasien (tambah, edit, hapus, lihat detail)</li>
                    <li><strong>Profil:</strong> Lihat dan update informasi profil Anda</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection