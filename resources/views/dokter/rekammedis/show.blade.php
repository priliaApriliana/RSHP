@extends('layouts.lte.main')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Detail</li>
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
    
    .gradient-header-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
    }
    
    .gradient-header-light {
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
    }
    
    .info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #D5DEEF;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(177, 201, 239, 0.3) !important;
    }
    
    .icon-wrapper-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background-color: rgba(177, 201, 239, 0.3);
        transition: transform 0.3s ease;
    }
    
    .icon-wrapper-light {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background-color: rgba(177, 201, 239, 0.3);
        transition: transform 0.3s ease;
    }
    
    .info-card:hover .icon-wrapper-blue,
    .info-card:hover .icon-wrapper-light {
        transform: scale(1.1) rotate(5deg);
    }
    
    .table-hover tbody tr {
        transition: all 0.3s ease;
    }
    
    .table-hover tbody tr:hover {
        background-color: rgba(98, 142, 11, 0.05);
    }
    
    .badge-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .badge-light-blue {
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
        color: #2c3e50;
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .action-btn {
        transition: all 0.3s ease;
    }
    
    .action-btn:hover {
        transform: scale(1.1);
    }
    
    .info-box {
        background-color: #F0F3FA;
        border-left: 4px solid var(--primary-blue);
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .info-box-light {
        border-left-color: var(--light-blue);
    }
    
    .info-box:hover {
        background-color: #e8ecf7;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state-icon {
        font-size: 5rem;
        color: #B1C9EF;
        margin-bottom: 1rem;
    }
    
    .btn-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-blue:hover {
        background: linear-gradient(135deg, #395686 0%, #2a4066 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 11, 0.3);
        color: white;
    }
    
    .btn-light-blue {
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
        border: none;
        color: #2c3e50;
        transition: all 0.3s ease;
    }
    
    .btn-light-blue:hover {
        background: linear-gradient(135deg, #8AAEE0 0%, #7299a0 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(177, 201, 239, 0.3);
        color: #2c3e50;
    }
    
    .number-badge {
        width: 35px;
        height: 35px;
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 0.9rem;
    }
</style>

<!-- Header Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-clipboard-data me-2" style="color: var(--primary-blue);"></i> 
                Detail Rekam Medis
            </h3>
            <p class="text-muted mb-0">Informasi lengkap pemeriksaan dan tindakan pasien</p>
        </div>
        <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card-header gradient-header-blue text-white border-0 py-3">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-stethoscope me-2"></i> Data Rekam Medis
        </h5>
        <div class="d-flex gap-2">
            <span class="badge bg-white" style="color: var(--primary-blue);">
                <i class="bi bi-calendar-check me-1"></i>
                {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y, H:i') }}
            </span>
            {{--  TAMBAH TOMBOL EDIT --}}
            @if($temuDokter->status === 'P')
            <a href="{{ route('dokter.rekammedis.edit', $rekamMedis->idrekam_medis) }}"
               class="btn btn-sm btn-light">
                <i class="bi bi-pencil-square me-1"></i> Edit Rekam Medis
            </a>
            @endif
        </div>
    </div>
</div>

<!-- Patient Summary Cards -->
<div class="row g-4 mb-4">
    <!-- Pet Info Card -->
    <div class="col-lg-6">
        <div class="card info-card border-0 shadow-sm h-100">
            <div class="card-header gradient-header-blue text-white border-0 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-paw-fill me-2"></i> Informasi Hewan
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="icon-wrapper-blue me-3">
                        <i class="bi bi-paw-fill fs-4" style="color: var(--primary-blue);"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Nama Hewan</small>
                        <h4 class="mb-0 fw-bold text-dark">{{ $temuDokter->nama ?? '-' }}</h4>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-6">
                        <div class="p-3 rounded h-100" style="background-color: rgba(177, 201, 239, 0.2);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-tag-fill me-2" style="color: var(--primary-blue);"></i>
                                <small class="text-muted fw-medium">Jenis Hewan</small>
                            </div>
                            <strong class="d-block" style="color: var(--dark-blue);">
                                {{ $temuDokter->nama_jenis_hewan ?? '-' }}
                            </strong>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded h-100" style="background-color: rgba(177, 201, 239, 0.2);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-collection-fill me-2" style="color: var(--primary-blue);"></i>
                                <small class="text-muted fw-medium">Ras</small>
                            </div>
                            <strong class="d-block" style="color: var(--dark-blue);">
                                {{ $temuDokter->nama_ras ?? '-' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Owner Info Card -->
    <div class="col-lg-6">
        <div class="card info-card border-0 shadow-sm h-100">
            <div class="card-header gradient-header-light border-0 py-3" style="color: #2c3e50;">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-person-fill me-2"></i> Informasi Pemilik
                </h5>
            </div>
            <div class="card-body p-4">
                <div class="d-flex align-items-center mb-4 pb-3 border-bottom">
                    <div class="icon-wrapper-light me-3">
                        <i class="bi bi-person-fill fs-4" style="color: var(--light-blue);"></i>
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Nama Pemilik</small>
                        <h4 class="mb-0 fw-bold text-dark">{{ $temuDokter->user_nama ?? '-' }}</h4>
                    </div>
                </div>
                
                <div class="row g-3">
                    <div class="col-12">
                        <div class="p-3 rounded" style="background-color: rgba(177, 201, 239, 0.2);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-telephone-fill me-2" style="color: var(--light-blue);"></i>
                                <small class="text-muted fw-medium">No. Telepon</small>
                            </div>
                            <a href="https://wa.me/{{ preg_replace('/\D/', '', $temuDokter->no_wa ?? '') }}" 
                               target="_blank" 
                               class="text-decoration-none d-flex align-items-center">
                                <i class="bi bi-whatsapp me-2" style="color: #25D366;"></i>
                                <strong style="color: var(--dark-blue);">{{ $temuDokter->no_wa ?? '-' }}</strong>
                            </a>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="p-3 rounded" style="background-color: rgba(177, 201, 239, 0.2);">
                            <div class="d-flex align-items-center mb-2">
                                <i class="bi bi-envelope-fill me-2" style="color: var(--light-blue);"></i>
                                <small class="text-muted fw-medium">Email</small>
                            </div>
                            <strong class="d-block text-break" style="color: var(--dark-blue);">
                                {{ $temuDokter->email ?? '-' }}
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Medical Record Card -->
<div class="card info-card border-0 shadow-sm mb-4">
    <div class="card-header gradient-header-blue text-white border-0 py-3">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-stethoscope me-2"></i> Data Rekam Medis
            </h5>
            <span class="badge bg-white" style="color: var(--primary-blue);">
                <i class="bi bi-calendar-check me-1"></i>
                {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d M Y, H:i') }}
            </span>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row g-4">
            <!-- Anamnesa -->
            <div class="col-md-6">
                <div class="info-box h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-chat-quote" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-2" style="color: var(--primary-blue);">Anamnesa</h6>
                            <p class="mb-0 text-dark">{{ $rekamMedis->anamnesa }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Temuan Klinis -->
            <div class="col-md-6">
                <div class="info-box info-box-light h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-search-heart" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-2" style="color: var(--primary-blue);">Temuan Klinis</h6>
                            <p class="mb-0 text-dark">{{ $rekamMedis->temuan_klinis }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Diagnosa -->
            <div class="col-12">
                <div class="info-box h-100">
                    <div class="d-flex align-items-start">
                        <div class="icon-wrapper-light me-3">
                            <i class="bi bi-prescription2" style="color: var(--light-blue);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-bold mb-2" style="color: var(--primary-blue);">Diagnosa</h6>
                            <p class="mb-0 text-dark">{{ $rekamMedis->diagnosa }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Action Therapy Details -->
<div class="card info-card border-0 shadow-sm">
    <div class="card-header gradient-header-light border-0 py-3" style="color: #2c3e50;">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h5 class="mb-0 fw-semibold">
                <i class="bi bi-list-check me-2"></i> Detail Tindakan Terapi
            </h5>
            <a href="{{ route('dokter.detail_rekammedis.create', $rekamMedis->idrekam_medis) }}" 
               class="btn btn-light btn-sm shadow-sm" style="color: #2c3e50;">
                <i class="bi bi-plus-lg me-2"></i> Tambah Tindakan
            </a>
        </div>
    </div>
    
    @if($detailRekamMedis->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead style="background-color: #F0F3FA;">
                <tr>
                    <th width="60" class="text-center py-3 fw-semibold">
                        <i class="bi bi-hash text-muted"></i>
                    </th>
                    <th class="py-3 fw-semibold">
                        <i class="bi bi-code-square me-2" style="color: var(--primary-blue);"></i>Kode
                    </th>
                    <th class="py-3 fw-semibold">
                        <i class="bi bi-file-text me-2" style="color: var(--primary-blue);"></i>Deskripsi Tindakan
                    </th>
                    <th class="py-3 fw-semibold">
                        <i class="bi bi-chat-left-text me-2" style="color: var(--light-blue);"></i>Detail
                    </th>
                    <th width="120" class="text-center py-3 fw-semibold">
                        <i class="bi bi-gear text-muted"></i> Aksi
                    </th>
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
            <i class="bi bi-inbox empty-state-icon d-block"></i>
            <h5 class="fw-bold text-dark mb-2">Belum Ada Tindakan Terapi</h5>
            <p class="text-muted mb-4">Mulai tambahkan tindakan terapi untuk rekam medis ini</p>
            <a href="{{ route('dokter.detail_rekammedis.create', $rekamMedis->idrekam_medis) }}" 
               class="btn btn-blue btn-lg shadow">
                <i class="bi bi-plus-circle me-2"></i> Tambah Tindakan Pertama
            </a>
        </div>
    </div>
    @endif
</div>

<script>
    // Initialize Bootstrap tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });
</script>

@endsection