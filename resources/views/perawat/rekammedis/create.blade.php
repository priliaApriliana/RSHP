@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')
<style>
    :root {
        --primary-color: #628ECB;
        --primary-dark: #395886;
        --primary-light: #8AAEE0;
        --secondary-light: #B1C9EF;
        --bg-light: #D5DEEF;
        --bg-lighter: #F0F3FA;
    }

    .form-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        overflow: hidden;
    }

    .form-card .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        padding: 20px 24px;
    }

    .form-card .card-header h4 {
        color: white;
        font-weight: 700;
        font-size: 20px;
        margin: 0;
    }

    .form-card .card-body {
        padding: 32px 24px;
    }

    .info-section {
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
        border: 2px solid #D5DEEF;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .info-row {
        display: flex;
        padding: 8px 0;
        border-bottom: 1px solid rgba(98, 142, 203, 0.1);
    }

    .info-row:last-child {
        border-bottom: none;
    }

    .info-label {
        font-weight: 600;
        color: #395886;
        min-width: 150px;
    }

    .info-value {
        color: #395886;
        font-weight: 500;
    }

    .form-label {
        font-weight: 600;
        color: #395886;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .form-select,
    .form-control {
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        padding: 12px 16px;
        background: white;
        color: #395886;
        transition: all 0.3s ease;
    }

    .form-select:focus,
    .form-control:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
        outline: none;
    }

    .form-control::placeholder {
        color: #8AAEE0;
    }

    h5 {
        color: #395886;
        font-weight: 700;
        font-size: 18px;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 3px solid #D5DEEF;
    }

    .tindakan-item {
        background: linear-gradient(135deg, #F0F3FA 0%, #ffffff 100%);
        border: 2px solid #D5DEEF;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.1);
        transition: all 0.3s ease;
    }

    .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        border: none;
        border-radius: 10px;
        padding: 10px 20px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(39, 174, 96, 0.4);
    }

    .btn-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 12px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        border-radius: 10px;
        padding: 14px 40px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        font-size: 16px;
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


    .text-danger {
        color: #e74c3c;
    }

    .alert-info {
        background: linear-gradient(135deg, #D5DEEF 0%, #F0F3FA 100%);
        border: 2px solid #B1C9EF;
        border-radius: 12px;
        color: #395886;
        padding: 16px;
    }
</style>

<div class="card form-card">
    <div class="card-header">
        <h4><i class="fas fa-plus-circle"></i> Input Data Rekam Medis</h4>
        <p class="mb-0 text-white" style="font-size: 14px; opacity: 0.9;">Lengkapi anamnesa, temuan klinis, dan diagnosa untuk pasien ini</p>
    </div>
    <div class="card-body">
        <form action="{{ route('perawat.rekammedis.store') }}" method="POST">
            @csrf
            
            <!-- Pilih Reservasi/Pasien -->
            <h5 class="mb-3">Pilih Pasien</h5>
            <div class="mb-4">
                <label class="form-label">Reservasi Temu Dokter <span class="text-danger">*</span></label>
                <select name="idreservasi_dokter" id="selectReservasi" class="form-select" required>
                    <option value="">-- Pilih Pasien dari Antrian --</option>
                    @foreach($temuDokter as $td)
                        <option value="{{ $td->idreservasi_dokter }}" 
                                data-hewan="{{ $td->nama_hewan }}"
                                data-jenis="{{ $td->nama_jenis_hewan }}"
                                data-ras="{{ $td->nama_ras }}"
                                data-pemilik="{{ $td->nama_pemilik }}"
                                data-nourut="{{ $td->no_urut }}"
                                data-tanggal="{{ \Carbon\Carbon::parse($td->waktu_daftar)->format('d/m/Y') }}"
                                {{ old('idreservasi_dokter') == $td->idreservasi_dokter ? 'selected' : '' }}>
                            No. {{ $td->no_urut }} | {{ $td->nama_hewan }} ({{ $td->nama_jenis_hewan }}) | Pemilik: {{ $td->nama_pemilik }}
                        </option>
                    @endforeach
                </select>
                @error('idreservasi_dokter')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <!-- Info Pasien (Auto-fill saat pilih reservasi) -->
            <div id="infoSection" class="info-section d-none">
                <h6 style="color: #395886; font-weight: 700; margin-bottom: 16px; border: none; padding: 0;">
                    <i class="fas fa-info-circle"></i> Informasi Pasien
                </h6>
                <div class="row">
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label">Nama Hewan:</span>
                            <span class="info-value" id="infoHewan">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Jenis:</span>
                            <span class="info-value" id="infoJenis">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Ras:</span>
                            <span class="info-value" id="infoRas">-</span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="info-row">
                            <span class="info-label">Pemilik:</span>
                            <span class="info-value" id="infoPemilik">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">No. Urut:</span>
                            <span class="info-value" id="infoNourut">-</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal Daftar:</span>
                            <span class="info-value" id="infoTanggal">-</span>
                        </div>
                    </div>
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


            <div class="alert alert-info mt-3">
                <i class="fas fa-info-circle"></i> <strong>Informasi Penting:</strong> 
                Setelah menyimpan rekam medis ini, Anda dapat menambahkan detail tindakan/terapi yang diberikan kepada pasien. Status pasien akan otomatis berubah menjadi "Selesai" setelah rekam medis disimpan.
            </div>

            <div class="d-flex gap-2 justify-content-between">
                {{-- TOMBOL BATAL --}}
                <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-outline-secondary">
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

@section('scripts')
<script>
$(document).ready(function() {

    function updateInfoPasien() {
        const selected = $('#selectReservasi option:selected');

        if (selected.val()) {
            $('#infoHewan').text(selected.data('hewan') ?? '-');
            $('#infoJenis').text(selected.data('jenis') ?? '-');
            $('#infoRas').text(selected.data('ras') ?? '-');
            $('#infoPemilik').text(selected.data('pemilik') ?? '-');
            $('#infoNourut').text(selected.data('nourut') ?? '-');
            $('#infoTanggal').text(selected.data('tanggal') ?? '-');

            $('#infoSection').removeClass('d-none');
        } else {
            $('#infoSection').addClass('d-none');
        }
    }

    // 🔥 SAAT GANTI SELECT
    $('#selectReservasi').on('change', function () {
        updateInfoPasien();
    });

    // 🔥 SAAT PAGE LOAD (INI YANG HILANG SELAMA INI)
    updateInfoPasien();

});
</script>
@endsection
