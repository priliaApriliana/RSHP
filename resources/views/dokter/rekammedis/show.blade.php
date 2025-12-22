@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

{{-- Load CSS Khusus Halaman Detail --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/dokter/show.css') }}">
@endsection

@section('content')

{{-- Header Section --}}
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3>
                <i class="bi bi-clipboard-data me-2"></i> 
                Detail Rekam Medis
            </h3>
            <p class="subtitle mb-0">Informasi lengkap pemeriksaan dan tindakan pasien</p>
        </div>
        <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

{{-- Patient Summary Cards --}}
<div class="row g-4 mb-4">
    {{-- Pet Info Card --}}
    <div class="col-lg-6">
        <div class="card info-card h-100">
            <div class="card-header gradient-header-blue">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-paw-fill me-2"></i> Informasi Hewan
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="icon-wrapper-blue me-3">
                        <i class="bi bi-bug fs-4" style="color: var(--primary-blue);"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Nama Hewan</small>
                        <h4 class="mb-0 fw-bold text-dark">{{ $temuDokter->nama_pet ?? '-' }}</h4>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="detail-box">
                            <small>
                                <i class="bi bi-tag-fill me-1"></i> Jenis Hewan
                            </small>
                            <strong class="d-block">
                                {{ $temuDokter->nama_jenis_hewan ?? '-' }}
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="detail-box">
                            <small>
                                <i class="bi bi-collection-fill me-1"></i> Ras
                            </small>
                            <strong class="d-block">
                                {{ $temuDokter->nama_ras ?? '-' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Owner Info Card --}}
    <div class="col-lg-6">
        <div class="card info-card h-100">
            <div class="card-header gradient-header-light">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-person-fill me-2"></i> Informasi Pemilik
                </h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="icon-wrapper-light me-3">
                        <i class="bi bi-person-fill fs-4" style="color: var(--light-blue);"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Nama Pemilik</small>
                        <h4 class="mb-0 fw-bold text-dark">{{ $temuDokter->nama_pemilik ?? '-' }}</h4>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-12">
                        <div class="detail-box">
                            <small>
                                <i class="bi bi-telephone-fill me-1"></i> No. Telepon
                            </small>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $temuDokter->no_wa ?? '') }}" 
                               target="_blank" 
                               class="whatsapp-link">
                                <i class="bi bi-whatsapp"></i>
                                {{ $temuDokter->no_wa ?? '-' }}
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="detail-box">
                            <small>
                                <i class="bi bi-envelope-fill me-1"></i> Email
                            </small>
                            <strong class="d-block text-break">
                                {{ $temuDokter->email ?? '-' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Medical Record Card --}}
<div class="card info-card mb-4">
    <div class="card-header gradient-header-blue">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-stethoscope me-2"></i> Data Rekam Medis
            </h5>
            <div class="d-flex gap-2">
                <span class="badge bg-white" style="color: var(--primary-blue);">
                    <i class="bi bi-calendar-check me-1"></i>
                    {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y, H:i') }}
                </span>
                @if($temuDokter->status === 'P')
                <a href="{{ route('dokter.rekammedis.edit', $rekamMedis->idrekam_medis) }}"
                   class="btn btn-sm btn-light">
                    <i class="bi bi-pencil-square me-1"></i> Edit
                </a>
                @endif
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-4">
            {{-- Anamnesa --}}
            <div class="col-md-6">
                <div class="info-box h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-chat-quote" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Anamnesa</h6>
                            <p>{{ $rekamMedis->anamnesa }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Temuan Klinis --}}
            <div class="col-md-6">
                <div class="info-box info-box-light h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-search-heart" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Temuan Klinis</h6>
                            <p>{{ $rekamMedis->temuan_klinis }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Diagnosa --}}
            <div class="col-12">
                <div class="info-box h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-prescription2" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6>Diagnosa</h6>
                            <p>{{ $rekamMedis->diagnosa }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Action Therapy Details --}}
<div class="card info-card">
    <div class="card-header gradient-header-light">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-list-check me-2"></i> Detail Tindakan Terapi
            </h5>
            <a href="{{ route('dokter.detail_rekammedis.create', $rekamMedis->idrekam_medis) }}" 
               class="btn btn-light-blue btn-sm">
                <i class="bi bi-plus-lg me-2"></i> Tambah Tindakan
            </a>
        </div>
    </div>
    
    @if($detailRekamMedis->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th width="60" class="text-center py-3">No</th>
                    <th class="py-3">
                        <i class="bi bi-code-square me-2"></i>Kode
                    </th>
                    <th class="py-3">
                        <i class="bi bi-file-text me-2"></i>Deskripsi Tindakan
                    </th>
                    <th class="py-3">
                        <i class="bi bi-chat-left-text me-2"></i>Detail
                    </th>
                    <th width="120" class="text-center py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detailRekamMedis as $index => $detail)
                <tr>
                    <td class="text-center">
                        <div class="number-badge">
                            {{ $loop->iteration }}
                        </div>
                    </td>
                    <td>
                        <span class="badge badge-blue">
                            {{ $detail->kode ?? '-' }}
                        </span>
                    </td>
                    <td>
                        <strong class="text-dark">{{ $detail->deskripsi_tindakan_terapi ?? '-' }}</strong>
                    </td>
                    <td>
                        <p class="mb-0 text-muted" style="max-width: 400px;">
                            {{ $detail->detail ?? '-' }}
                        </p>
                    </td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('dokter.detail_rekammedis.edit', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}" 
                               class="btn btn-sm btn-warning action-btn" 
                               title="Edit"
                               data-bs-toggle="tooltip">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('dokter.detail_rekammedis.destroy', [$rekamMedis->idrekam_medis, $detail->iddetail_rekam_medis]) }}" 
                                  method="POST" 
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="btn btn-sm btn-danger action-btn" 
                                        onclick="return confirm('Yakin ingin menghapus tindakan ini?')" 
                                        title="Hapus"
                                        data-bs-toggle="tooltip">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-inbox empty-state-icon"></i>
            <h5>Belum Ada Tindakan Terapi</h5>
            <p>Mulai tambahkan tindakan terapi untuk rekam medis ini</p>
            <a href="{{ route('dokter.detail_rekammedis.create', $rekamMedis->idrekam_medis) }}" 
               class="btn btn-blue btn-lg">
                <i class="bi bi-plus-circle me-2"></i> Tambah Tindakan Pertama
            </a>
        </div>
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script>
// Initialize Bootstrap tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@endsection