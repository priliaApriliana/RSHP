@extends('layouts.lte.main')

@section('page-title', 'Detail Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.rekammedis.index') }}">Rekam Medis</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')

<style>
:root {
    --blue-light: #8AAEE0;
    --blue-soft: #B1C9EF;
    --blue-main: #628ECB;
    --blue-bg: #D5DEEF;
    --blue-dark: #395886;
    --blue-white: #F0F3FA;
}

/* ===== CARD ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98,142,203,.15);
    overflow: hidden;
}

.card-header {
    padding: 20px 24px;
    background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
    color: white;
}

.card-title {
    font-weight: 700;
    font-size: 18px;
}

/* ===== TABLE INFO ===== */
.table-borderless th {
    width: 40%;
    color: var(--blue-dark);
    font-weight: 600;
    padding: 10px 8px;
}

.table-borderless td {
    color: var(--blue-dark);
    padding: 10px 8px;
}

/* ===== INFO BOX ===== */
.info-box {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
    border: 2px solid var(--blue-bg);
    border-radius: 12px;
    padding: 16px;
    color: var(--blue-dark);
    white-space: pre-wrap;
}

/* ===== SECTION TITLE ===== */
.section-title {
    font-weight: 700;
    color: var(--blue-dark);
    border-left: 4px solid var(--blue-main);
    padding-left: 12px;
    margin-bottom: 10px;
}

/* ===== BADGE ===== */
.badge-primary,
.badge-secondary {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    color: white;
    font-weight: 600;
    border-radius: 8px;
    padding: 6px 12px;
}

/* ===== TABLE TINDAKAN ===== */
.table-bordered {
    border-radius: 12px;
    overflow: hidden;
    border: 2px solid var(--blue-bg);
}

.table-bordered thead th {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
    color: var(--blue-dark);
    font-weight: 600;
}

.table-bordered td {
    color: var(--blue-dark);
    border-color: var(--blue-bg);
}

/* ===== BUTTON ===== */
.btn-primary,
.btn-secondary,
.btn-warning {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    border: none;
    font-weight: 600;
    color: white;
    border-radius: 10px;
    padding: 10px 22px;
}

.card-footer {
    background: var(--blue-white);
    border-top: 2px solid var(--blue-bg);
    padding: 20px 24px;
}
</style>

<div class="container-fluid">

<div class="row">
    <!-- INFORMASI HEWAN -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-paw"></i> Informasi Hewan</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th>Nama Hewan</th><td>: {{ $temu->nama_hewan ?? '-' }}</td></tr>
                    <tr><th>Jenis</th><td>: {{ $temu->nama_jenis_hewan ?? '-' }}</td></tr>
                    <tr><th>Ras</th><td>: {{ $temu->nama_ras ?? '-' }}</td></tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>:
                            @if($temu->jenis_kelamin)
                                <span class="badge badge-primary">
                                    {{ $temu->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                                </span>
                            @else -
                            @endif
                        </td>
                    </tr>
                    <tr><th>Tanggal Lahir</th><td>: {{ $temu->tanggal_lahir ? \Carbon\Carbon::parse($temu->tanggal_lahir)->format('d M Y') : '-' }}</td></tr>
                    <tr><th>Warna/Tanda</th><td>: {{ $temu->warna_tanda ?? '-' }}</td></tr>
                </table>
            </div>
        </div>

        <!-- PEMILIK -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-user"></i> Informasi Pemilik</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th>Nama</th><td>: {{ $temu->nama_pemilik ?? '-' }}</td></tr>
                    <tr><th>No. WA</th><td>: {{ $temu->no_wa ?? '-' }}</td></tr>
                    <tr><th>Alamat</th><td>: {{ $temu->alamat ?? '-' }}</td></tr>
                </table>
            </div>
        </div>
    </div>

    <!-- DETAIL REKAM MEDIS -->
    <div class="col-md-6">
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-medical"></i> Detail Rekam Medis</h3>
            </div>
            <div class="card-body">
                <table class="table table-borderless">
                    <tr><th>Tanggal Pemeriksaan</th><td>: {{ \Carbon\Carbon::parse($rekamMedis->created_at)->format('d/m/Y H:i') }}</td></tr>
                    <tr><th>Dokter</th><td>: {{ $dokter->nama ?? '-' }}</td></tr>
                </table>

                <hr>

                <div class="mb-3">
                    <div class="section-title">Anamnesa</div>
                    <div class="info-box">{{ $rekamMedis->anamnesa }}</div>
                </div>

                <div class="mb-3">
                    <div class="section-title">Temuan Klinis</div>
                    <div class="info-box">{{ $rekamMedis->temuan_klinis }}</div>
                </div>

                <div class="mb-3">
                    <div class="section-title">Diagnosa</div>
                    <div class="info-box">{{ $rekamMedis->diagnosa }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- TINDAKAN -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-syringe"></i> Tindakan / Terapi</h3>
    </div>
    <div class="card-body">
        @if($detail && $detail->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th class="text-center">Kode</th>
                    <th>Tindakan</th>
                    <th>Kategori</th>
                    <th>Catatan</th>
                </tr>
            </thead>
            <tbody>
                @foreach($detail as $d)
                <tr>
                    <td class="text-center"><span class="badge badge-secondary">T{{ $d->idkode_tindakan_terapi }}</span></td>
                    <td>{{ $d->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $d->nama_kategori }}</td>
                    <td>{{ $d->detail ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="alert alert-info">Tidak ada tindakan/terapi.</div>
        @endif
    </div>

    <div class="card-footer text-end">
        <a href="{{ route('perawat.rekammedis.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
        <a href="{{ route('perawat.rekammedis.edit', $rekamMedis->idrekam_medis) }}" class="btn btn-warning">
            <i class="fas fa-edit"></i> Edit
        </a>
        <button onclick="window.print()" class="btn btn-primary">
            <i class="fas fa-print"></i> Cetak
        </button>
    </div>
</div>

</div>
@endsection
