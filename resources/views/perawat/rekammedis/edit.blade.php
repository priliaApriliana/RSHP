@extends('layouts.lte.main')

@section('page-title', 'Edit Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<style>
    .content-header {
        padding: 15px 0;
    }
    
    .card {
        border: none;
        box-shadow: 0 2px 4px rgba(0,0,0,.08);
        margin-bottom: 1.5rem;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .card-header {
        padding: 1rem 1.25rem;
        border-bottom: none;
    }
    
    .card-header.bg-info-gradient {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }
    
    .card-header.bg-purple-gradient {
        background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
        color: white;
    }
    
    .card-header.bg-teal-gradient {
        background: linear-gradient(135deg, #20c997 0%, #1aa179 100%);
        color: white;
    }
    
    .card-header.bg-orange-gradient {
        background: linear-gradient(135deg, #fd7e14 0%, #e8590c 100%);
        color: white;
    }
    
    .card-header.bg-primary-gradient {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }
    
    .card-title i {
        margin-right: 8px;
    }
    
    .info-row {
        padding: 10px 0;
        border-bottom: 1px solid #e9ecef;
        display: flex;
        align-items: center;
    }
    
    .info-row:last-child {
        border-bottom: none;
    }
    
    .info-label {
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
        min-width: 130px;
    }
    
    .info-value {
        color: #212529;
        font-weight: 500;
    }
    
    .readonly-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #dee2e6;
        border-radius: 6px;
        padding: 15px;
        min-height: 80px;
        white-space: pre-wrap;
        color: #495057;
    }
    
    .tindakan-item {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
        border: 2px solid #e3e6ea;
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,.05);
    }
    
    .btn-add-tindakan {
        margin-top: 10px;
    }
    
    .table-bordered thead th {
        background: linear-gradient(135deg, #e9ecef 0%, #dee2e6 100%);
        font-weight: 600;
        color: #495057;
        border: 1px solid #dee2e6;
    }
    
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0,123,255,.03);
    }
    
    .badge-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
        padding: 5px 10px;
        font-weight: 500;
    }
    
    .alert-info {
        background: linear-gradient(135deg, #d1ecf1 0%, #bee5eb 100%);
        border-color: #b8daff;
        color: #004085;
    }
    
    .btn-success {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(40,167,69,.3);
    }
    
    .btn-success:hover {
        background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
        box-shadow: 0 3px 6px rgba(40,167,69,.4);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(0,123,255,.3);
    }
    
    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3 0%, #004085 100%);
        box-shadow: 0 3px 6px rgba(0,123,255,.4);
    }
    
    .btn-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        border: none;
        font-weight: 600;
        box-shadow: 0 2px 4px rgba(220,53,69,.3);
    }
    
    .btn-danger:hover {
        background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
        box-shadow: 0 3px 6px rgba(220,53,69,.4);
    }
    
    .btn-default {
        background: #fff;
        border: 2px solid #dee2e6;
        color: #6c757d;
        font-weight: 600;
    }
    
    .btn-default:hover {
        background: #f8f9fa;
        border-color: #adb5bd;
        color: #495057;
    }
    
    h6.text-primary {
        color: #007bff !important;
        font-weight: 600;
        border-left: 4px solid #007bff;
        padding-left: 10px;
    }
    
    h6.text-secondary {
        color: #6c757d !important;
        font-weight: 600;
        border-left: 4px solid #6c757d;
        padding-left: 10px;
    }
    
    h6.text-info {
        color: #17a2b8 !important;
        font-weight: 600;
        border-left: 4px solid #17a2b8;
        padding-left: 10px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
            </div>
        </div>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="{{ route('perawat.rekammedis.update', $rekamMedis->idrekam_medis) }}" method="POST">
        @csrf

        {{-- Error Messages --}}
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
            {{-- Informasi Pasien & Pemilik --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-info-gradient">
                        <h3 class="card-title"><i class="fas fa-info-circle"></i>Informasi Pasien & Pemilik</h3>
                    </div>
                    <div class="card-body">
                        <h6 class="text-primary mb-3"><i class="fas fa-paw"></i> Detail Hewan</h6>
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

                        <h6 class="text-primary mb-3 mt-4"><i class="fas fa-user"></i> Detail Pemilik</h6>
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

            {{-- Anamnesa & Temuan Klinis --}}
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-purple-gradient">
                        <h3 class="card-title"><i class="fas fa-clipboard-list"></i>Anamnesa (Keluhan)</h3>
                    </div>
                    <div class="card-body">
                        <div class="readonly-box">{{ $rekamMedis->anamnesa }}</div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-teal-gradient">
                        <h3 class="card-title"><i class="fas fa-stethoscope"></i>Temuan Klinis</h3>
                    </div>
                    <div class="card-body">
                        <div class="readonly-box">{{ $rekamMedis->temuan_klinis }}</div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form: Diagnosa --}}
        <div class="card">
            <div class="card-header bg-orange-gradient">
                <h3 class="card-title"><i class="fas fa-notes-medical"></i>Diagnosa <span class="text-warning">*</span></h3>
            </div>
            <div class="card-body">
                <textarea name="diagnosa" rows="5" class="form-control @error('diagnosa') is-invalid @enderror" 
                    required>{{ old('diagnosa', $rekamMedis->diagnosa) }}</textarea>
                @error('diagnosa')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Form: Tindakan & Terapi --}}
        <div class="card">
            <div class="card-header bg-primary-gradient">
                <h3 class="card-title"><i class="fas fa-syringe"></i>Tindakan & Terapi</h3>
            </div>
            <div class="card-body">
                @if($detail->count() > 0)
                <h6 class="text-secondary mb-3"><i class="fas fa-history"></i> Riwayat Tindakan (Tidak dapat diubah)</h6>
                <div class="table-responsive mb-4">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="width: 15%">Kode</th>
                                <th style="width: 35%">Tindakan</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $d)
                            <tr>
                                <td><span class="badge badge-secondary">T{{ $d->idkode_tindakan_terapi }}</span></td>
                                <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                                <td>{{ $d->detail ?? '-' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

                <h6 class="text-info mb-3"><i class="fas fa-plus-circle"></i> Tambah Tindakan Baru</h6>
                <div id="tindakan-container"></div>

                <button type="button" class="btn btn-success btn-add-tindakan" onclick="tambahTindakan()">
                    <i class="fas fa-plus"></i> Tambah Tindakan
                </button>

                <div class="alert alert-info mt-3">
                    <i class="fas fa-info-circle"></i> <strong>Penting:</strong> Riwayat tindakan yang sudah ada tidak dapat diubah. Silakan tambahkan tindakan baru jika diperlukan.
                </div>
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-default">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>

    </form>
        </div>
    </section>
</div>

{{-- Script dinamis untuk menambah tindakan baru --}}
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
                <label>Tindakan <span class="text-danger">*</span></label>
                <select name="tindakan[]" class="form-control" required>
                    <option value="">Pilih Tindakan</option>
                    @foreach($tindakanTerapi as $t)
                    <option value="{{ $t->idkode_tindakan_terapi }}">{{ $t->deskripsi_tindakan_terapi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5">
                <label>Detail / Keterangan</label>
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