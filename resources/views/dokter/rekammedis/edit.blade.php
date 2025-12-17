@extends('layouts.lte.main')

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
    
    .gradient-header-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
    }
    
    .gradient-header-light {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
    }

    .gradient-header-warning {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
    }
    
    .info-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 16px;
        overflow: hidden;
    }
    
    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(98, 142, 203, 0.15) !important;
    }
    
    .form-control:focus,
    .form-select:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
        outline: none;
    }
    
    .form-control,
    .form-select {
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        padding: 12px 16px;
        background: white;
        color: #395886;
        transition: all 0.3s ease;
    }

    .form-label {
        font-weight: 600;
        color: #395886;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .btn-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 10px;
        padding: 14px 40px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
    }
    
    .btn-blue:hover {
        background: linear-gradient(135deg, #395886 0%, #2d4570 100%);
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(98, 142, 203, 0.4);
        color: white;
    }

    .btn-success-gradient {
        background: linear-gradient(135deg, #395886 0%, #2d4570 100%);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 10px;
        padding: 10px 20px;
        box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
    }

    .btn-success-gradient:hover {
        background: linear-gradient(135deg, #395886 0%, #2d4570 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.4);
        color: white;
    }

    .btn-danger-gradient {
        background: linear-gradient(135deg, #031493ff 0%, #16068fff 100%);
        border: none;
        color: white;
        font-weight: 600;
        transition: all 0.3s ease;
        border-radius: 8px;
        padding: 8px 12px;
        box-shadow: 0 2px 8px rgba(9, 15, 138, 0.3);
    }

    .btn-danger-gradient:hover {
        background: linear-gradient(135deg, #0c0455ff 0%, #091168ff 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 71, 169, 0.4);
        color: white;
    }

    .btn-outline-secondary {
        background: white;
        border: 2px solid #D5DEEF;
        color: #395886;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }

    .btn-outline-secondary:hover {
        background: #F0F3FA;
        border-color: #B1C9EF;
        color: #395886;
    }
    
    .info-box {
        background: linear-gradient(135deg, #D5DEEF 0%, #F0F3FA 100%);
        border: 2px solid #B1C9EF;
        border-left: 4px solid #628ECB;
        border-radius: 12px;
        padding: 1.5rem;
        transition: all 0.3s ease;
    }
    
    .info-box:hover {
        background: linear-gradient(135deg, #F0F3FA 0%, #ffffff 100%);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.1);
    }

    .table-bordered {
        border: 2px solid #D5DEEF !important;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 12px;
        overflow: hidden;
    }

    .table-bordered thead th {
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
        color: #395886;
        font-weight: 600;
        border: 2px solid #D5DEEF !important;
        padding: 14px 12px;
    }

    .table-bordered tbody td {
        border: 1px solid #D5DEEF !important;
        border-right: 2px solid #D5DEEF !important;
        border-left: 2px solid #D5DEEF !important;
        padding: 14px 12px;
        color: #395886;
        vertical-align: middle;
    }

    .table-bordered tbody td:first-child {
        border-left: 2px solid #D5DEEF !important;
    }

    .table-bordered tbody td:last-child {
        border-right: 2px solid #D5DEEF !important;
    }

    .table-bordered tbody tr:last-child td {
        border-bottom: 2px solid #D5DEEF !important;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(240, 243, 250, 0.5);
    }

    .badge-blue {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        color: white;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
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

    .tindakan-item:hover {
        border-color: #B1C9EF;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
    }

    .section-divider {
        border-top: 3px solid #D5DEEF;
        margin: 2rem 0;
    }

    .card-header h5 {
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin: 0;
    }

    .card-body {
        padding: 32px 24px;
    }

    h6 {
        color: #395886;
        font-weight: 700;
        font-size: 16px;
        margin-bottom: 16px;
    }

    .text-danger {
        color: #0a2889ff;
    }

    .text-muted {
        color: #8AAEE0 !important;
    }

    small {
        font-size: 13px;
    }
</style>

<!-- Header Section -->
<div class="mb-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <h3 class="fw-bold mb-1" style="color: #395886;">
                <i class="bi bi-pencil-square me-2" style="color: #628ECB;"></i> 
                Edit Rekam Medis
            </h3>
            <p class="text-muted mb-0">Lengkapi anamnesa, temuan klinis, diagnosa dan tindakan terapi</p>
        </div>
        <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </a>
    </div>
</div>

<form action="{{ route('dokter.rekammedis.update', $rekamMedis->idrekam_medis) }}" method="POST">
    @csrf
    @method('PUT')

    <!-- Patient Info Card -->
    <div class="card info-card shadow-sm mb-4">
        <div class="card-header gradient-header-blue border-0 py-3">
            <h5 class="mb-0">
                <i class="bi bi-info-circle me-2"></i> Informasi Pasien
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-paw-fill me-2"></i>Nama Hewan
                    </label>
                    <input type="text" class="form-control" value="{{ $temuDokter->nama_pet }}" readonly style="background-color: #f8f9fa;">
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-person-fill me-2"></i>Pemilik
                    </label>
                    <input type="text" class="form-control" value="{{ $temuDokter->nama_pemilik }}" readonly style="background-color: #f8f9fa;">
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-tag me-2"></i>Jenis Hewan
                    </label>
                    <input type="text" class="form-control" value="{{ $temuDokter->nama_jenis_hewan }}" readonly style="background-color: #f8f9fa;">
                </div>

                <div class="col-md-6">
                    <label class="form-label">
                        <i class="bi bi-collection me-2"></i>Ras
                    </label>
                    <input type="text" class="form-control" value="{{ $temuDokter->nama_ras }}" readonly style="background-color: #f8f9fa;">
                </div>
            </div>
        </div>
    </div>

    <!-- Medical Information Card -->
    <div class="card info-card shadow-sm mb-4">
        <div class="card-header gradient-header-light text-white border-0 py-3">
            <h5 class="mb-0">
                <i class="bi bi-clipboard-pulse me-2"></i> Data Medis
            </h5>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <!-- Anamnesa -->
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-chat-left-quote me-2"></i>Anamnesa (Keluhan) <span class="text-danger">*</span>
                    </label>
                    <textarea name="anamnesa" 
                              class="form-control @error('anamnesa') is-invalid @enderror"
                              rows="4"
                              placeholder="Keluhan utama, riwayat penyakit, dan informasi dari pemilik..."
                              required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                    @error('anamnesa')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Tuliskan keluhan utama, riwayat penyakit, dan informasi penting dari pemilik
                    </small>
                </div>

                <!-- Temuan Klinis -->
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-search-heart me-2"></i>Temuan Klinis <span class="text-danger">*</span>
                    </label>
                    <textarea name="temuan_klinis" 
                              class="form-control @error('temuan_klinis') is-invalid @enderror"
                              rows="4"
                              placeholder="Hasil pemeriksaan fisik, vital signs, dan temuan objektif..."
                              required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                    @error('temuan_klinis')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Catat hasil pemeriksaan fisik, vital signs (suhu, nadi, respirasi), dan temuan klinis lainnya
                    </small>
                </div>

                <!-- Diagnosa -->
                <div class="col-12">
                    <label class="form-label">
                        <i class="bi bi-prescription2 me-2"></i>Diagnosa <span class="text-danger">*</span>
                    </label>
                    <textarea name="diagnosa" 
                              class="form-control @error('diagnosa') is-invalid @enderror"
                              rows="4"
                              placeholder="Diagnosa berdasarkan anamnesa dan temuan klinis..."
                              required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                    @error('diagnosa')
                        <div class="invalid-feedback d-block">
                            <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                        </div>
                    @enderror
                    <small class="text-muted d-block mt-1">
                        <i class="bi bi-info-circle me-1"></i>
                        Tuliskan diagnosa utama dan diagnosa diferensial jika ada
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Tindakan Terapi Card -->
    <div class="card info-card shadow-sm mb-4">
        <div class="card-header gradient-header-warning text-white border-0 py-3">
            <h5 class="mb-0">
                <i class="bi bi-prescription2 me-2"></i> Tindakan & Terapi
            </h5>
        </div>
        <div class="card-body">
            
            <!-- Riwayat Tindakan (jika ada) -->
            @php
                $existingTindakan = DB::table('detail_rekam_medis')
                    ->join('kode_tindakan_terapi', 'detail_rekam_medis.idkode_tindakan_terapi', '=', 'kode_tindakan_terapi.idkode_tindakan_terapi')
                    ->select('detail_rekam_medis.*', 'kode_tindakan_terapi.kode', 'kode_tindakan_terapi.deskripsi_tindakan_terapi')
                    ->where('detail_rekam_medis.idrekam_medis', $rekamMedis->idrekam_medis)
                    ->get();
            @endphp

            @if($existingTindakan->count() > 0)
                <h6 class="mb-3">
                    <i class="bi bi-clock-history me-2"></i>Riwayat Tindakan
                </h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Kode</th>
                                <th style="width: 40%">Tindakan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($existingTindakan as $tindakan)
                            <tr>
                                <td><span class="badge badge-blue">{{ $tindakan->kode }}</span></td>
                                <td>{{ $tindakan->deskripsi_tindakan_terapi }}</td>
                                <td>{{ $tindakan->detail ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="section-divider"></div>
            @endif

            <!-- Form Tambah Tindakan Baru -->
            <h6 class="mb-3">
                <i class="bi bi-plus-circle me-2"></i>Tambah Tindakan Baru
            </h6>

            <div id="tindakan-container">
                <!-- Tindakan item pertama -->
                <div class="tindakan-item">
                    <div class="row g-3 align-items-end">
                        <div class="col-md-5">
                            <label class="form-label">
                                Tindakan <span class="text-danger">*</span>
                            </label>
                            <select name="tindakan[]" class="form-select" required>
                                <option value="">-- Pilih Tindakan --</option>
                                @php
                                    $kodeTindakan = DB::table('kode_tindakan_terapi')
                                        ->join('kategori', 'kode_tindakan_terapi.idkategori', '=', 'kategori.idkategori')
                                        ->select('kode_tindakan_terapi.*', 'kategori.nama_kategori')
                                        ->orderBy('kode_tindakan_terapi.kode')
                                        ->get();
                                @endphp
                                @foreach($kodeTindakan as $kt)
                                    <option value="{{ $kt->idkode_tindakan_terapi }}">
                                        [{{ $kt->kode }}] {{ $kt->deskripsi_tindakan_terapi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">
                                Detail / Keterangan
                            </label>
                            <input type="text" name="detail[]" class="form-control" 
                                   placeholder="Contoh: dosis standar, 2x sehari, dll">
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-danger-gradient w-100 remove-tindakan d-none">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <button type="button" id="add-tindakan" class="btn btn-success-gradient mt-3">
                <i class="bi bi-plus-circle me-2"></i> Tambah Tindakan
            </button>

            <div class="info-box mt-4">
                <h6 class="mb-2">
                    <i class="bi bi-lightbulb me-2"></i>Informasi Penting
                </h6>
                <p class="mb-0 text-muted small">
                    Riwayat tindakan yang sudah ada tidak dapat diubah atau dihapus dari form ini. 
                    Anda dapat menambahkan tindakan baru sesuai kebutuhan. Untuk mengedit atau menghapus tindakan yang sudah ada, 
                    silakan gunakan tombol edit/hapus pada halaman detail rekam medis.
                </p>
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="card info-card shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex gap-2 justify-content-between">
                <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle me-2"></i> Batal
                </a>
                <button type="submit" class="btn btn-blue">
                    <i class="bi bi-check-circle me-2"></i> Simpan Rekam Medis
                </button>
            </div>
        </div>
    </div>
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let tindakanCount = 1;

    document.getElementById('add-tindakan').addEventListener('click', function() {
        tindakanCount++;
        
        const container = document.getElementById('tindakan-container');
        const newItem = document.createElement('div');
        newItem.className = 'tindakan-item';
        newItem.innerHTML = `
            <div class="row g-3 align-items-end">
                <div class="col-md-5">
                    <label class="form-label">
                        Tindakan <span class="text-danger">*</span>
                    </label>
                    <select name="tindakan[]" class="form-select" required>
                        <option value="">-- Pilih Tindakan --</option>
                        @foreach($kodeTindakan as $kt)
                            <option value="{{ $kt->idkode_tindakan_terapi }}">
                                [{{ $kt->kode }}] {{ $kt->deskripsi_tindakan_terapi }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">
                        Detail / Keterangan
                    </label>
                    <input type="text" name="detail[]" class="form-control" 
                           placeholder="Contoh: dosis standar, 2x sehari, dll">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-danger-gradient w-100 remove-tindakan">
                        <i class="bi bi-trash"></i>
                    </button>
                </div>
            </div>
        `;
        
        container.appendChild(newItem);
        updateRemoveButtons();
    });

    document.addEventListener('click', function(e) {
        if (e.target.closest('.remove-tindakan')) {
            e.target.closest('.tindakan-item').remove();
            tindakanCount--;
            updateRemoveButtons();
        }
    });

    function updateRemoveButtons() {
        const removeButtons = document.querySelectorAll('.remove-tindakan');
        if (tindakanCount > 1) {
            removeButtons.forEach(btn => btn.classList.remove('d-none'));
        } else {
            removeButtons.forEach(btn => btn.classList.add('d-none'));
        }
    }

    updateRemoveButtons();
});
</script>

@endsection