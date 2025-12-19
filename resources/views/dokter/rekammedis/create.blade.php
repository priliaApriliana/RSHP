@extends('layouts.lte.main')

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
    
    .info-box {
        background-color: #fafbfd;
        border-left: 4px solid var(--primary-blue);
        border-radius: 8px;
        padding: 1.5rem;
        transition: all 0.3s ease;
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
                <i class="bi bi-plus-circle me-2" style="color: var(--primary-blue);"></i> 
                Periksa Pasien Baru
            </h3>
            <p class="text-muted mb-0">Buat rekam medis untuk pemeriksaan pasien</p>
        </div>
        <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<div class="card info-card border-0 shadow-sm">
    <div class="card-header gradient-header-blue text-white border-0 py-3">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-form-check me-2"></i> Form Pemeriksaan Pasien
        </h5>
    </div>

    <div class="card-body p-4">

        <form action="{{ route('dokter.rekammedis.store') }}" method="POST">
            @csrf

            <input type="hidden" name="idreservasi_dokter" value="{{ $pasien->idreservasi_dokter }}">

            <!-- Patient Info -->
            <div class="row g-3 mb-4 pb-4 border-bottom">
                {{-- NAMA HEWAN --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                        <i class="bi bi-paw-fill me-2"></i>Nama Hewan
                    </label>
                    <input type="text" class="form-control" value="{{ $pasien->nama }}" readonly style="background-color: #f8f9fa;">
                </div>

                {{-- PEMILIK --}}
                <div class="col-md-6">
                    <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                        <i class="bi bi-person-fill me-2"></i>Pemilik
                    </label>
                    <input type="text" class="form-control" value="{{ $pasien->nama_pemilik }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>

            <!-- Medical Information -->
            <div class="row g-3 mb-4">
                {{-- ANAMNESA --}}
                <div class="col-12">
                    <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                        <i class="bi bi-chat-left-quote me-2"></i>Anamnesa <span class="text-danger">*</span>
                    </label>
                    <textarea name="anamnesa" 
                              class="form-control @error('anamnesa') is-invalid @enderror"
                              rows="4"
                              placeholder="Keluhan utama dan riwayat kesehatan pasien..."
                              required></textarea>
                    @error('anamnesa')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- TEMUAN KLINIS --}}
                <div class="col-12">
                    <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                        <i class="bi bi-search-heart me-2"></i>Temuan Klinis <span class="text-danger">*</span>
                    </label>
                    <textarea name="temuan_klinis" 
                              class="form-control @error('temuan_klinis') is-invalid @enderror"
                              rows="4"
                              placeholder="Hasil pemeriksaan fisik dan temuan klinis..."
                              required></textarea>
                    @error('temuan_klinis')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- DIAGNOSA --}}
                <div class="col-12">
                    <label class="form-label fw-semibold" style="color: var(--primary-blue);">
                        <i class="bi bi-prescription2 me-2"></i>Diagnosa <span class="text-danger">*</span>
                    </label>
                    <textarea name="diagnosa" 
                              class="form-control @error('diagnosa') is-invalid @enderror"
                              rows="4"
                              placeholder="Diagnosa berdasarkan temuan klinis..."
                              required></textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>

            <div class="d-flex gap-2 justify-content-between">
                {{-- TOMBOL BATAL --}}
                <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left-circle me-2"></i> Batal
                </a>

                {{-- SIMPAN --}}
                <button type="submit" class="btn btn-blue">
                    <i class="bi bi-check-circle me-2"></i> Simpan Rekam Medis
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
