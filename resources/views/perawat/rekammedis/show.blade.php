@extends('layouts.lte.main')

@section('page-title', 'Detail Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')

<style>
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
    
    .card-header.bg-primary-gradient {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        color: white;
    }
    
    .card-header.bg-info-gradient {
        background: linear-gradient(135deg, #17a2b8 0%, #138496 100%);
        color: white;
    }
    
    .card-header.bg-success-gradient {
        background: linear-gradient(135deg, #28a745 0%, #218838 100%);
        color: white;
    }
    
    .card-header.bg-warning-gradient {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        color: #212529;
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
    }
    
    .card-title i {
        margin-right: 8px;
    }
    
    .table-borderless th {
        font-weight: 600;
        color: #495057;
        padding: 10px 8px;
    }
    
    .table-borderless td {
        padding: 10px 8px;
        color: #212529;
    }
    
    .info-box {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        border: 2px solid #dee2e6;
        border-radius: 6px;
        padding: 15px;
        margin-bottom: 15px;
        color: #495057;
    }
    
    .info-box strong {
        color: #212529;
        display: block;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    
    .badge-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        padding: 5px 10px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .badge-danger {
        background: linear-gradient(135deg, #dc3545 0%, #c82333 100%);
        padding: 5px 10px;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .badge-secondary {
        background: linear-gradient(135deg, #6c757d 0%, #545b62 100%);
        padding: 5px 10px;
        font-weight: 500;
        font-size: 0.9rem;
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
    
    .btn-secondary {
        background: #6c757d;
        border: none;
        font-weight: 600;
    }
    
    .btn-warning {
        background: linear-gradient(135deg, #ffc107 0%, #e0a800 100%);
        border: none;
        font-weight: 600;
        color: #212529;
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
        border: none;
        font-weight: 600;
    }
    
    .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 3px 6px rgba(0,0,0,.2);
    }
</style>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">

            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Informasi Hewan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary-gradient">
                            <h3 class="card-title"><i class="fas fa-paw"></i>Informasi Hewan</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%;">Nama Hewan</th>
                                    <td>: {{ $temu->nama_hewan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Hewan</th>
                                    <td>: {{ $temu->nama_jenis_hewan ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Ras</th>
                                    <td>: {{ $temu->nama_ras ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Jenis Kelamin</th>
                                    <td>: 
                                        @if($temu->jenis_kelamin == 'J')
                                            <span class="badge badge-primary">Jantan</span>
                                        @elseif($temu->jenis_kelamin == 'B')
                                            <span class="badge badge-danger">Betina</span>
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Lahir</th>
                                    <td>: 
                                        @if($temu->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($temu->tanggal_lahir)->format('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Warna/Tanda</th>
                                    <td>: {{ $temu->warna_tanda ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Informasi Pemilik -->
                    <div class="card">
                        <div class="card-header bg-info-gradient">
                            <h3 class="card-title"><i class="fas fa-user"></i>Informasi Pemilik</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%;">Nama</th>
                                    <td>: {{ $temu->nama_pemilik ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>No. WhatsApp</th>
                                    <td>: {{ $temu->no_wa ?? '-' }}</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>: {{ $temu->alamat ?? '-' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Detail Rekam Medis -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success-gradient">
                            <h3 class="card-title"><i class="fas fa-file-medical"></i>Detail Rekam Medis</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <th style="width: 40%;">Tanggal Pemeriksaan</th>
                                    <td>: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Dokter Pemeriksa</th>
                                    <td>: {{ $dokter->nama ?? '-' }}</td>
                                </tr>
                            </table>

                            <hr>

                            <div class="mb-3">
                                <strong><i class="fas fa-clipboard-list"></i> Anamnesa (Keluhan)</strong>
                                <div class="info-box mt-2">
                                    {{ $rekamMedis->anamnesa }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong><i class="fas fa-stethoscope"></i> Temuan Klinis</strong>
                                <div class="info-box mt-2">
                                    {{ $rekamMedis->temuan_klinis }}
                                </div>
                            </div>

                            <div class="mb-3">
                                <strong><i class="fas fa-notes-medical"></i> Diagnosa</strong>
                                <div class="info-box mt-2">
                                    {{ $rekamMedis->diagnosa }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tindakan/Terapi -->
            <div class="card">
                <div class="card-header bg-warning-gradient">
                    <h3 class="card-title"><i class="fas fa-syringe"></i>Tindakan/Terapi</h3>
                </div>
                <div class="card-body">
                    @if($detail && $detail->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="10%" class="text-center">Kode</th>
                                        <th width="35%">Tindakan</th>
                                        <th width="20%">Kategori</th>
                                        <th>Detail/Catatan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($detail as $d)
                                    <tr>
                                        <td class="text-center">
                                            <span class="badge badge-secondary">T{{ $d->idkode_tindakan_terapi }}</span>
                                        </td>
                                        <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                                        <td>{{ $d->nama_kategori }}</td>
                                        <td>
                                            @if($d->detail)
                                                {{ $d->detail }}
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> Tidak ada tindakan/terapi yang tercatat.
                        </div>
                    @endif
                </div>

                <div class="card-footer">
                    <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <a href="{{ route('perawat.rekammedis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button type="button" class="btn btn-primary" onclick="window.print()">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection