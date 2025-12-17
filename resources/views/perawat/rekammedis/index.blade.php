@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rekam Medis</li>
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

/* ===== ALERT ===== */
.alert-success,
.alert-danger {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
    border: 2px solid var(--blue-soft);
    border-radius: 12px;
    color: var(--blue-dark);
    padding: 16px 20px;
}

/* ===== SEARCH CARD ===== */
.search-card {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98, 142, 203, .15);
}

.search-card .form-control {
    border: 2px solid var(--blue-bg);
    border-radius: 10px;
    padding: 12px 16px;
    color: var(--blue-dark);
}

.search-card .form-control:focus {
    border-color: var(--blue-main);
    box-shadow: 0 0 0 4px rgba(98, 142, 203, .15);
}

.search-card .btn-primary {
    background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
    border: none;
    border-radius: 10px;
    font-weight: 600;
}

/* ===== TABLE CARD ===== */
.table-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98, 142, 203, .15);
    overflow: hidden;
}

.table-card .card-header {
    background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
    color: white;
    padding: 20px 24px;
}

.table-card .card-title {
    font-weight: 700;
    font-size: 18px;
}

/* ===== TABLE ===== */
.table thead {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
}

.table thead th {
    color: var(--blue-dark);
    font-weight: 600;
    border: 1px solid var(--blue-bg);
}

.table tbody td {
    color: var(--blue-dark);
    border: 1px solid var(--blue-bg);
}

.table tbody tr:hover {
    background: var(--blue-white);
}

/* ===== BADGE ===== */
.badge-secondary {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    color: white;
    font-weight: 600;
    border-radius: 6px;
}

/* ===== BUTTONS ===== */
.btn-success,
.btn-info,
.btn-warning {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 8px;
}

.btn-success:hover,
.btn-info:hover,
.btn-warning:hover {
    opacity: .9;
}

/* ===== TEXT ===== */
tbody strong {
    color: var(--blue-dark);
}
</style>


@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="bi bi-check-circle"></i> {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="bi bi-exclamation-circle"></i> {{ session('error') }}
</div>
@endif

<div class="card search-card">
    <div class="card-body">
        <form method="GET" action="{{ route('perawat.rekammedis.index') }}">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}"
                           placeholder="Cari nama hewan, pemilik, atau diagnosa..."
                           class="form-control">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><i class="bi bi-clipboard-list"></i> Daftar Rekam Medis</h3>
        <div class="card-tools">
            <a href="{{ route('perawat.rekammedis.create') }}" class="btn btn-success btn-sm">
                <i class="bi bi-plus"></i> Tambah Rekam Medis
            </a>
        </div>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;" class="text-center">No</th>
                    <th style="width: 120px;">Tanggal</th>
                    <th>Nama Hewan</th>
                    <th>Pemilik</th>
                    <th>Dokter</th>
                    <th>Anamnesa</th>
                    <th>Temuan Klinis</th>
                    <th>Diagnosa</th>
                    <th class="text-center" style="width: 140px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rekam as $i => $rm)
                <tr>
                    <td class="text-center">{{ $rekam->firstItem() + $i }}</td>
                    <td>
                        <span class="badge badge-secondary">
                            {{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y') }}
                        </span>
                        <br>
                        <small style="color: #8AAEE0;">{{ \Carbon\Carbon::parse($rm->created_at)->format('H:i') }}</small>
                    </td>
                    <td><strong>{{ $rm->nama_hewan }}</strong></td>
                    <td>{{ $rm->nama_pemilik }}</td>
                    <td>{{ $rm->nama_dokter ?? 'Belum diperiksa' }}</td>
                    <td style="max-width: 200px;">
                        <div style="max-height: 60px; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($rm->anamnesa, 80) }}
                        </div>
                    </td>
                    <td style="max-width: 200px;">
                        <div style="max-height: 60px; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($rm->temuan_klinis, 80) }}
                        </div>
                    </td>
                    <td style="max-width: 200px;">
                        <div style="max-height: 60px; overflow: hidden; text-overflow: ellipsis;">
                            {{ Str::limit($rm->diagnosa, 80) }}
                        </div>
                    </td>

                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            <a href="{{ route('perawat.rekammedis.show', $rm->idrekam_medis) }}" 
                               class="btn btn-info btn-sm"
                               data-toggle="tooltip"
                               title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('perawat.rekammedis.edit', $rm->idrekam_medis) }}" 
                               class="btn btn-warning btn-sm"
                               data-toggle="tooltip"
                               title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center text-muted py-4">
                        <i class="bi bi-inbox fa-3x mb-3 d-block"></i>
                        Tidak ada data rekam medis ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($rekam->hasPages())
    <div class="card-footer clearfix">
        {{ $rekam->links() }}
    </div>
    @endif
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush