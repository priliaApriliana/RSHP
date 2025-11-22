@extends('layouts.lte.main')

@section('page-title', 'Detail Rekam Medis')

@section('content')

<div class="container mt-3">

    <!-- Tombol kembali -->
    <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-secondary mb-3">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <!-- Judul -->
    <h3 class="mb-3">
        <i class="fas fa-file-medical"></i> Detail Rekam Medis
    </h3>

    <!-- Card Informasi Utama -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Informasi Hewan & Pemilik</strong>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nama Pet</div>
                <div class="col-md-8">{{ $rekammedis->temu->pet->nama ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Jenis Hewan</div>
                <div class="col-md-8">{{ $rekammedis->temu->pet->jenisHewan->nama_jenis_hewan ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Nama Pemilik</div>
                <div class="col-md-8">{{ $rekammedis->temu->pet->pemilik->nama ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Kontak Pemilik</div>
                <div class="col-md-8">{{ $rekammedis->temu->pet->pemilik->telepon ?? '-' }}</div>
            </div>

        </div>
    </div>


    <!-- Card Pemeriksaan -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Informasi Pemeriksaan</strong>
        </div>

        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Dokter Pemeriksa</div>
                <div class="col-md-8">{{ $rekammedis->dokter_pemeriksa ?? '-' }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Tanggal Pemeriksaan</div>
                <div class="col-md-8">
                    {{ $rekammedis->created_at ? $rekammedis->created_at->format('d M Y - H:i') : '-' }}
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4 fw-bold">Diagnosa</div>
                <div class="col-md-8">{{ $rekammedis->diagnosa ?? '-' }}</div>
            </div>

        </div>
    </div>


    <!-- Card Tindakan -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Tindakan & Terapi</strong>
        </div>

        <div class="card-body">

            @if($rekammedis->tindakan)
                {!! nl2br(e($rekammedis->tindakan)) !!}
            @else
                <span class="text-muted">Belum ada tindakan atau terapi dicatat.</span>
            @endif

        </div>
    </div>

</div>

@endsection
