@extends('layouts.lte.main')

@section('page-title', 'Detail Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.pasien.index') }}">Data Pasien</a></li>
    <li class="breadcrumb-item active">Detail Pasien</li>
@endsection

@section('content')
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