@extends('layouts.lte.main')

@section('page-title', 'Detail Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.pasien.index') }}">Data Pasien</a></li>
    <li class="breadcrumb-item active">Detail Pasien</li>
@endsection

@section('content')
<style>
    /* Color Palette Variables */
    :root {
        --primary-color: #628ECB;
        --primary-dark: #395886;
        --primary-light: #8AAEE0;
        --secondary-light: #B1C9EF;
        --bg-light: #D5DEEF;
        --bg-lighter: #F0F3FA;
    }

    /* Card Primary Styling */
    .card-primary {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        overflow: hidden;
        margin-bottom: 24px;
    }

    .card-primary > .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        padding: 20px 24px;
    }

    .card-primary .card-title {
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin: 0;
    }

    .card-primary .card-title i {
        margin-right: 8px;
    }

    .card-primary .card-body {
        background: white;
        padding: 32px 24px;
    }

    /* Card Success Styling */
    .card-success {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        overflow: hidden;
    }

    .card-success > .card-header {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        padding: 20px 24px;
    }

    .card-success .card-title {
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin: 0;
    }

    .card-success .card-title i {
        margin-right: 8px;
    }

    .card-success .card-body {
        background: white;
        padding: 32px 24px;
    }

    /* Table Borderless Styling */
    .table-borderless th {
        color: #395886;
        font-weight: 600;
        font-size: 14px;
        padding: 12px 8px;
        border: none;
    }

    .table-borderless td {
        color: #395886;
        padding: 12px 8px;
        border: none;
    }

    .table-borderless td strong {
        color: #395886;
        font-weight: 700;
        font-size: 16px;
    }

    .table-borderless .text-muted {
        color: #8AAEE0 !important;
        font-size: 13px;
    }

    /* Badge Styling */
    .badge-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%) !important;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        color: white;
    }

    .badge-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        color: white;
    }

    .badge-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%) !important;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        color: white;
    }

    .badge-success {
        background: linear-gradient(135deg, #27ae60 0%, #229954 100%) !important;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        color: white;
    }

    .badge-warning {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%) !important;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
        color: white;
    }

    /* Table Hover Styling */
    .table-hover thead.table-light {
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
    }

    .table-hover thead th {
        color: #395886;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 2px solid #B1C9EF;
        padding: 16px 12px;
    }

    .table-hover tbody td {
        color: #395886;
        padding: 16px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #F0F3FA;
    }

    .table-hover tbody tr:hover {
        background: linear-gradient(135deg, #F0F3FA 0%, rgba(241, 243, 250, 0.5) 100%);
    }

    /* Alert Info */
    .alert-info {
        background: linear-gradient(135deg, #D5DEEF 0%, #F0F3FA 100%);
        border: 2px solid #B1C9EF;
        border-radius: 12px;
        color: #395886;
        padding: 16px 20px;
    }

    .alert-info i {
        color: #628ECB;
        margin-right: 8px;
    }

    /* Button Styling */
    .btn-info {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        border-radius: 8px;
        padding: 8px 16px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(138, 174, 224, 0.3);
    }

    .btn-info:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 174, 224, 0.4);
        color: white;
    }

    .btn-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(138, 174, 224, 0.3);
    }

    .btn-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(138, 174, 224, 0.4);
        color: white;
    }

    /* Card Footer */
    .card-footer {
        background: #F0F3FA;
        border-top: 2px solid #D5DEEF;
        padding: 20px 24px;
    }

    /* Table Responsive */
    .table-responsive {
        border-radius: 12px;
        overflow: hidden;
    }
</style>

<!-- Info Pasien -->
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-paw"></i> Informasi Pasien</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Nama Pet:</th>
                        <td><strong>{{ $pet->nama }}</strong></td>
                    </tr>
                    <tr>
                        <th>Jenis Hewan:</th>
                        <td>{{ $pet->nama_jenis_hewan ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Ras:</th>
                        <td>{{ $pet->nama_ras ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir:</th>
                        <td>
                            @if($pet->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d F Y') }}
                                <br>
                                <small class="text-muted">({{ \Carbon\Carbon::parse($pet->tanggal_lahir)->age }} tahun)</small>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                </table>
            </div>
            <div class="col-md-6">
                <table class="table table-borderless">
                    <tr>
                        <th style="width: 200px;">Jenis Kelamin:</th>
                        <td>
                            @php
                                $jenisKelamin = strtoupper(trim($pet->jenis_kelamin ?? ''));
                            @endphp
                            @if($jenisKelamin === 'J')
                                <span class="badge badge-primary"><i class="fas fa-mars"></i> Jantan</span>
                            @elseif($jenisKelamin === 'B')
                                <span class="badge badge-danger"><i class="fas fa-venus"></i> Betina</span>
                            @else
                                <span class="badge badge-secondary">Tidak Diketahui</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Warna/Tanda:</th>
                        <td>{{ $pet->warna_tanda ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Pemilik:</th>
                        <td>{{ $pet->nama_pemilik ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Kontak:</th>
                        <td>{{ $pet->no_wa ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th>Alamat:</th>
                        <td>{{ $pet->alamat ?? '-' }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Riwayat Rekam Medis -->
<div class="card card-success">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-clipboard-list"></i> Riwayat Rekam Medis</h3>
    </div>
    <div class="card-body">
        @if($riwayatRekam->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                            <th>Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($riwayatRekam as $i => $rekam)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($rekam->waktu_daftar)->format('d/m/Y') }}</td>
                            <td>{{ $rekam->diagnosa ?? '-' }}</td>
                            <td>{{ $rekam->nama_dokter ?? '-' }}</td>
                            <td>
                                @if($rekam->status === 'D')
                                    <span class="badge badge-success">Selesai</span>
                                @elseif($rekam->status === 'W')
                                    <span class="badge badge-warning">Menunggu</span>
                                @else
                                    <span class="badge badge-secondary">{{ $rekam->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('perawat.rekammedis.show', $rekam->idrekam_medis) }}" 
                                   class="btn btn-sm btn-info">
                                    <i class="fas fa-eye"></i> Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada riwayat rekam medis untuk pasien ini.
            </div>
        @endif
    </div>
    <div class="card-footer">
        <a href="{{ route('perawat.pasien.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</div>
@endsection