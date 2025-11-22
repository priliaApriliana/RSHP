@extends('layouts.lte.main')

@section('content')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4"><i class="fas fa-user-nurse"></i> Dashboard Perawat</h3>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="stat-card">
                    <div class="stat-title">Total Rekam Medis</div>
                    <div class="stat-value">{{ $totalRekamMedis }}</div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="stat-card">
                    <div class="stat-title">Rekam Medis Hari Ini</div>
                    <div class="stat-value">{{ $rekamMedisHariIni }}</div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-primary">
                <i class="fas fa-notes-medical"></i> Lihat Daftar Rekam Medis
            </a>
        </div>
    </div>
</div>
@endsection
