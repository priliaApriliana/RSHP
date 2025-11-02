<!-- untuk Menampilkan detail satu data saja berdasarkan ID -->
@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-notes-medical"></i> Detail Rekam Medis
        </h3>

        <div class="card p-4 shadow-sm">
            <p><strong>Nama Hewan:</strong> {{ $rekamMedis->temuDokter->pet->nama_pet ?? '-' }}</p>
            <p><strong>Pemilik:</strong> {{ $rekamMedis->temuDokter->pet->pemilik->user->nama ?? '-' }}</p>
            <p><strong>Anamnesa:</strong> {{ $rekamMedis->anamnesa }}</p>
            <p><strong>Temuan Klinis:</strong> {{ $rekamMedis->temuan_klinis }}</p>
            <p><strong>Diagnosa:</strong> {{ $rekamMedis->diagnosa }}</p>
            <p><strong>Tanggal:</strong> {{ $rekamMedis->created_at }}</p>

            <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-secondary mt-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
