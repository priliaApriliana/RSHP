@extends('layouts.lte.main')

@section('page-title', 'Edit Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Edit</li>
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

    .card {
        border: none;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        margin-bottom: 1.5rem;
        border-radius: 16px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 20px 24px;
        border-bottom: none;
    }
    
    .card-header.bg-info-gradient {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        color: white;
    }
    
    .card-header.bg-primary-gradient {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: white;
    }
    
    .card-header.bg-warning-gradient {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
    }
    
    .card-title {
        font-size: 18px;
        font-weight: 700;
        margin: 0;
    }
    
    .card-title i {
        margin-right: 8px;
    }
    
    .info-row {
        padding: 12px 0;
        border-bottom: 2px solid #F0F3FA;
        display: flex;
        align-items: center;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #395886;
        font-size: 14px;
        min-width: 130px;
    }
    
    .info-value {
        color: #395886;
        font-weight: 500;
    }
    
    .form-control,
    .form-select {
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        padding: 12px 16px;
        color: #395886;
        transition: all 0.3s ease;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
    }

    textarea.form-control {
        min-height: 120px;
    }

    .form-label {
        font-weight: 600;
        color: #395886;
        margin-bottom: 8px;
        font-size: 14px;
    }
    
    .tindakan-item {
        background: linear-gradient(135deg, #F0F3FA 0%, #ffffff 100%);
        border: 2px solid #D5DEEF;
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.1);
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
        font-weight: 600;
        color: #395886;
        border: 2px solid #D5DEEF !important;
        padding: 14px 12px;
    }

    .table-bordered tbody td {
        border: 1px solid #D5DEEF !important;
        padding: 14px 12px;
        color: #395886;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(240, 243, 250, 0.5);
    }
    
    .badge-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        padding: 6px 12px;
        font-weight: 600;
        border-radius: 8px;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #D5DEEF 0%, #F0F3FA 100%);
        border: 2px solid #B1C9EF;
        border-radius: 12px;
        color: #395886;
    }

    .alert-danger {
        background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
        border: 2px solid #f1b0b7;
        border-radius: 12px;
        color: #721c24;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(39, 174, 96, 0.3);
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        border-radius: 10px;
        padding: 12px 24px;
        transition: all 0.3s ease;
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(231, 76, 60, 0.3);
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .btn-default {
        background: white;
        border: 2px solid #D5DEEF;
        color: #395886;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px 24px;
        transition: all 0.3s ease;
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

    h6 {
        color: #395886;
        font-weight: 600;
        border-left: 4px solid #628ECB;
        padding-left: 12px;
        margin-bottom: 16px;
        margin-top: 16px;
    }
</style>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('perawat.rekammedis.update', $rekamMedis->idrekam_medis) }}" method="POST">
                @csrf

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h5><i class="icon fas fa-ban"></i> Terdapat kesalahan!</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    {{-- Informasi Pasien & Pemilik (READ ONLY) --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-info-gradient">
                                <h3 class="card-title"><i class="fas fa-info-circle"></i> Informasi Pasien & Pemilik</h3>
                            </div>
                            <div class="card-body">
                                <h6><i class="fas fa-paw"></i> Detail Hewan</h6>
                                <div class="info-row">
                                    <span class="info-label">Nama Hewan:</span>
                                    <span class="info-value ml-2">{{ $temu->nama_hewan }}</span>
                                </div>
                                @if(isset($temu->nama_ras))
                                <div class="info-row">
                                    <span class="info-label">Ras:</span>
                                    <span class="info-value ml-2">{{ $temu->nama_ras }}</span>
                                </div>
                                @endif
                                @if(isset($temu->jenis_kelamin))
                                <div class="info-row">
                                    <span class="info-label">Jenis Kelamin:</span>
                                    <span class="info-value ml-2">{{ $temu->jenis_kelamin }}</span>
                                </div>
                                @endif

                                <h6 class="mt-4"><i class="fas fa-user"></i> Detail Pemilik</h6>
                                <div class="info-row">
                                    <span class="info-label">Nama Pemilik:</span>
                                    <span class="info-value ml-2">{{ $temu->nama_pemilik }}</span>
                                </div>
                                @if(isset($temu->no_wa))
                                <div class="info-row">
                                    <span class="info-label">No. WhatsApp:</span>
                                    <span class="info-value ml-2">{{ $temu->no_wa }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Form Editable: Anamnesa, Temuan Klinis, Diagnosa --}}
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header bg-primary-gradient">
                                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Data Rekam Medis</h3>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="form-label">Anamnesa (Keluhan) <span class="text-danger">*</span></label>
                                    <textarea name="anamnesa" rows="4" class="form-control @error('anamnesa') is-invalid @enderror" 
                                        required>{{ old('anamnesa', $rekamMedis->anamnesa) }}</textarea>
                                    @error('anamnesa')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Temuan Klinis <span class="text-danger">*</span></label>
                                    <textarea name="temuan_klinis" rows="4" class="form-control @error('temuan_klinis') is-invalid @enderror" 
                                        required>{{ old('temuan_klinis', $rekamMedis->temuan_klinis) }}</textarea>
                                    @error('temuan_klinis')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Diagnosa <span class="text-danger">*</span></label>
                                    <textarea name="diagnosa" rows="4" class="form-control @error('diagnosa') is-invalid @enderror" 
                                        required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                                    @error('diagnosa')
                                        <span class="invalid-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="d-flex gap-2 justify-content-between">
                    {{-- TOMBOL BATAL --}}
                    <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle me-2"></i> Batal
                    </a>

                    {{-- SIMPAN --}}
                    <button type="submit" class="btn btn-blue">
                        <i class="bi bi-check-circle me-2"></i> Simpan perubahan
                    </button>
                </div>
            </form>
        </div>
    </section>
</div>

<script>
let tindakanCounter = 0;

function tambahTindakan() {
    const wrap = document.getElementById("tindakan-container");
    const el = document.createElement("div");
    el.className = "tindakan-item";
    el.id = "tindakan-" + tindakanCounter;

    el.innerHTML = `
        <div class="row">
            <div class="col-md-5">
                <label class="form-label">Tindakan <span class="text-danger">*</span></label>
                <select name="tindakan[]" class="form-control" required>
                    <option value="">Pilih Tindakan</option>
                    @foreach($tindakanTerapi as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->deskripsi_tindakan_terapi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label class="form-label">Detail / Keterangan</label>
                <input type="text" name="detail[]" class="form-control" placeholder="Contoh: dosis standar, 2x sehari">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="button" class="btn btn-danger btn-block" onclick="hapusTindakan(${tindakanCounter})">
                    <i class="fas fa-trash"></i> Hapus
                </button>
            </div>
        </div>
    `;

    wrap.appendChild(el);
    tindakanCounter++;
}

function hapusTindakan(id) {
    const el = document.getElementById("tindakan-" + id);
    if(el) el.remove();
}
</script>

@endsection