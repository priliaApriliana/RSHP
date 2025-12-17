@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dokter.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dokter.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Edit Tindakan</li>
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
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
    }
    
    .info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 1px solid #e0e8f0;
        border-radius: 12px;
        overflow: hidden;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(98, 142, 203, 0.15) !important;
    }
    
    .icon-wrapper-blue {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background-color: rgba(98, 142, 203, 0.15);
        transition: transform 0.3s ease;
    }
    
    .icon-wrapper-light {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        background-color: rgba(138, 174, 224, 0.2);
        transition: transform 0.3s ease;
    }
    
    .info-card:hover .icon-wrapper-blue,
    .info-card:hover .icon-wrapper-light {
        transform: scale(1.1) rotate(5deg);
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(98, 142, 203, 0.25);
    }
    
    .btn-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-blue:hover {
        background: linear-gradient(135deg, #395686 0%, #2d4570 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        color: white;
    }
    
    .btn-light-blue {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-light-blue:hover {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 174, 224, 0.3);
        color: white;
    }
    
    .badge-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: white;
    }
    
    .info-box {
        background-color: #fafbfd;
        border-left: 4px solid var(--primary-blue);
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .info-box-light {
        background-color: #f5f8fc;
        border-left-color: var(--light-blue);
    }
    
    .info-box:hover {
        background-color: #f0f3fa;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.1);
    }
</style>

<!-- Header Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold text-dark mb-1">
                <i class="bi bi-pencil-square me-2" style="color: var(--primary-blue);"></i> 
                Edit Tindakan Terapi
            </h3>
            <p class="text-muted mb-0">Perbarui data tindakan atau treatment pasien</p>
        </div>
        <a href="{{ route('dokter.rekammedis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Form Card -->
    <div class="col-lg-8">
        <div class="card info-card border-0 shadow-sm">
            <div class="card-header gradient-header-blue text-white border-0 py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-clipboard-list me-2"></i> Form Edit Tindakan
                </h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('dokter.detail_rekammedis.update', [$rekamMedis->idrekam_medis, $detailRekamMedis->iddetail_rekam_medis]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                            <i class="bi bi-code-square me-2"></i>Kode Tindakan <span class="text-danger">*</span>
                        </label>
                        <select name="idkode_tindakan_terapi" 
                                class="form-select @error('idkode_tindakan_terapi') is-invalid @enderror" 
                                required
                                style="border-color: var(--lighter-blue);">
                            <option value="">-- Pilih Kode Tindakan --</option>
                            @foreach($kodeTindakan as $item)
                                <option value="{{ $item->idkode_tindakan_terapi }}" 
                                    {{ $detailRekamMedis->idkode_tindakan_terapi == $item->idkode_tindakan_terapi ? 'selected' : '' }}>
                                    {{ $item->kode }} - {{ $item->deskripsi_tindakan_terapi }}
                                </option>
                            @endforeach
                        </select>
                        @error('idkode_tindakan_terapi')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                            <i class="bi bi-chat-left-text me-2"></i>Detail / Keterangan
                        </label>
                        <textarea name="detail" 
                                  class="form-control @error('detail') is-invalid @enderror" 
                                  rows="5"
                                  placeholder="Masukkan detail tindakan, hasil, atau catatan penting..."
                                  style="border-color: var(--lighter-blue); resize: vertical;">{{ old('detail', $detailRekamMedis->detail) }}</textarea>
                        @error('detail')
                            <div class="invalid-feedback d-block">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-blue">
                            <i class="bi bi-check-circle me-2"></i> Update Tindakan
                        </button>
                        <a href="{{ route('dokter.rekammedis.show', $rekamMedis->idrekam_medis) }}" class="btn btn-outline-secondary">
                            <i class="bi bi-x-circle me-2"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="col-lg-4">
        <div class="card info-card border-0 shadow-sm h-100">
            <div class="card-header gradient-header-light border-0 py-3" style="color: white;">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-info-circle me-2"></i> Informasi
                </h5>
            </div>
            <div class="card-body p-4" style="background-color: #f5f8fc;">
                <div class="info-box mb-4">
                    <h6 class="fw-bold mb-3" style="color: var(--primary-blue);">
                        <i class="bi bi-lightbulb me-2"></i>Panduan Edit
                    </h6>
                    <p class="mb-0 text-muted small">
                        Perbarui kode tindakan atau detail yang diperlukan. Pastikan data tetap akurat dan lengkap sebelum menyimpan perubahan.
                    </p>
                </div>

                <div class="info-box info-box-light">
                    <h6 class="fw-bold mb-3" style="color: var(--primary-blue);">
                        <i class="bi bi-clock-history me-2"></i>Tindakan Sekarang
                    </h6>
                    <div class="p-2 rounded" style="background-color: #f0f3fa; border-left: 3px solid var(--primary-blue);">
                        <small class="d-block text-muted mb-2">Kode Tindakan</small>
                        <strong class="d-block text-dark">{{ $detailRekamMedis->idkode_tindakan_terapi }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
