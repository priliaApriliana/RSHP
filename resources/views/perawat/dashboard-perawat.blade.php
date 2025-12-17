@extends('layouts.lte.main')

@section('page-title', 'Dashboard Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')

<style>
:root {
    --blue-light: #8AAEE0;
    --blue-soft: #B1C9EF;
    --blue-main: #628ECB;
    --blue-bg: #D5DEEF;
    --blue-dark: #395886;
    --blue-white: #F0F3FA;
}

/* ===== SMALL BOX ===== */
.small-box {
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98,142,203,.2);
    color: white;
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
}

.small-box .inner h3 {
    font-size: 36px;
    font-weight: 700;
}

.small-box .inner p {
    font-size: 16px;
    margin: 0;
}

.small-box .icon {
    color: rgba(255,255,255,.35);
}

.small-box-footer {
    background: rgba(255,255,255,.15);
    color: white;
    font-weight: 600;
}

.small-box-footer:hover {
    background: rgba(255,255,255,.25);
    color: white;
}

/* ===== CARD ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98,142,203,.15);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
    color: white;
    padding: 20px 24px;
}

.card-title {
    font-weight: 700;
    font-size: 18px;
}

/* ===== BUTTON ===== */
.btn-primary,
.btn-info,
.btn-success,
.btn-secondary {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 12px;
    padding: 14px;
}

.btn i {
    margin-right: 6px;
}

/* ===== INFO TEXT ===== */
.card-body p,
.card-body ul li {
    color: var(--blue-dark);
}
</style>

{{-- STATISTIC --}}
<div class="row">
    <div class="col-lg-4 col-6">
        <div class="small-box">
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

    <div class="col-lg-4 col-6">
        <div class="small-box">
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

    <div class="col-lg-4 col-6">
        <div class="small-box">
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

{{-- QUICK ACTION --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-bolt"></i> Aksi Cepat</h3>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('perawat.rekammedis.create') }}" class="btn btn-primary btn-block btn-lg">
                            <i class="fas fa-plus"></i> Tambah Rekam Medis
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('perawat.pasien.index') }}" class="btn btn-info btn-block btn-lg">
                            <i class="fas fa-search"></i> Data Pasien
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-success btn-block btn-lg">
                            <i class="fas fa-list"></i> Rekam Medis
                        </a>
                    </div>
                    <div class="col-md-3 mb-3">
                        <a href="{{ route('perawat.profil') }}" class="btn btn-secondary btn-block btn-lg">
                            <i class="fas fa-user"></i> Profil Saya
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- INFO --}}
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi</h3>
            </div>
            <div class="card-body">
                <p><strong>Selamat datang di Dashboard Perawat Rumah Sakit Hewan.</strong></p>
                <p>Gunakan menu di samping untuk mengakses fitur berikut:</p>
                <ul>
                    <li><strong>Data Pasien</strong> – Melihat dan mencari pasien hewan</li>
                    <li><strong>Rekam Medis</strong> – Kelola data rekam medis pasien</li>
                    <li><strong>Profil</strong> – Perbarui data akun Anda</li>
                </ul>
            </div>
        </div>
    </div>
</div>

@endsection
