@extends('layouts.lte.main')

@section('page-title', 'Data Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pasien</li>
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

    /* Filter Card Styling */
    .filter-card {
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        margin-bottom: 24px;
    }

    .filter-card .card-body {
        padding: 24px;
    }

    .filter-card .form-label {
        font-weight: 600;
        color: #395886;
        margin-bottom: 8px;
        font-size: 14px;
    }

    .filter-card .form-control,
    .filter-card .form-select {
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        padding: 12px 16px;
        background: white;
        color: #395886;
        transition: all 0.3s ease;
    }

    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
        outline: none;
    }

    .filter-card .form-control::placeholder {
        color: #8AAEE0;
    }

    .filter-card .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        border-radius: 10px;
        padding: 12px 24px;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        transition: all 0.3s ease;
    }

    .filter-card .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(98, 142, 203, 0.4);
    }

    /* Table Card Styling */
    .table-card {
        background: white;
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        overflow: hidden;
    }

    .table-card .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        padding: 20px 24px;
    }

    .table-card .card-title {
        color: white;
        font-weight: 700;
        font-size: 18px;
        margin: 0;
    }

    .table-card .table {
        margin-bottom: 0;
    }

    .table-card thead.table-light {
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
    }

    .table-card thead th {
        color: #395886;
        font-weight: 600;
        font-size: 14px;
        border-bottom: 2px solid #B1C9EF;
        padding: 16px 12px;
    }

    .table-card tbody td {
        color: #395886;
        padding: 16px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #F0F3FA;
    }

    .table-card tbody tr:hover {
        background: linear-gradient(135deg, #F0F3FA 0%, rgba(241, 243, 250, 0.5) 100%);
    }

    /* Badge Styling */
    .badge.bg-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%) !important;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge.bg-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%) !important;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
    }

    .badge.bg-secondary {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%) !important;
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 12px;
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

    /* Pagination Styling */
    .card-footer {
        background: #F0F3FA;
        border-top: 2px solid #D5DEEF;
        padding: 16px 24px;
    }

    .pagination .page-link {
        color: #395886;
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        margin: 0 4px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .pagination .page-link:hover {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        color: white;
        border-color: #628ECB;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-color: #395886;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.3);
    }

    /* Empty State */
    .text-muted {
        color: #8AAEE0 !important;
    }

    /* Strong Text */
    tbody strong {
        color: #395886;
        font-weight: 700;
    }
</style>

<!-- Filter Card -->
<div class="card filter-card">
    <div class="card-body">
        <form method="GET" action="{{ route('perawat.pasien.index') }}">
            <div class="row g-3">
                <!-- Search -->
                <div class="col-md-5">
                    <label class="form-label">Cari Pasien</label>
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}"
                           placeholder="Nama pet atau pemilik..."
                           class="form-control">
                </div>

                <!-- Filter Jenis Hewan -->
                <div class="col-md-4">
                    <label class="form-label">Jenis Hewan</label>
                    <select name="jenis_hewan" class="form-select">
                        <option value="">Semua Jenis</option>
                        @foreach($jenisHewan as $jh)
                            <option value="{{ $jh->idjenis_hewan }}" 
                                {{ request('jenis_hewan') == $jh->idjenis_hewan ? 'selected' : '' }}>
                                {{ $jh->nama_jenis_hewan }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Button -->
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-filter"></i> Filter
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Table Card -->
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title">Daftar Pasien Hewan</h3>
    </div>

    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th style="width: 60px;" class="text-center">No</th>
                    <th>Nama Pet</th>
                    <th>Jenis Hewan</th>
                    <th>Ras</th>
                    <th>Jenis Kelamin</th>
                    <th>Pemilik</th>
                    <th>Kontak</th>
                    <th class="text-center" style="width: 100px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($pasien as $i => $p)
                <tr>
                    <td class="text-center">{{ $pasien->firstItem() + $i }}</td>
                    <td><strong>{{ $p->nama }}</strong></td>
                    <td>{{ $p->nama_jenis_hewan ?? '-' }}</td>
                    <td>{{ $p->nama_ras ?? '-' }}</td>
                    <td>
                        @php
                            $jenisKelamin = strtoupper(trim($p->jenis_kelamin ?? ''));
                        @endphp
                        
                        @if($jenisKelamin === 'J')
                            <span class="badge bg-primary">
                                <i class="bi bi-gender-male"></i> Jantan
                            </span>
                        @elseif($jenisKelamin === 'B')
                            <span class="badge bg-danger">
                                <i class="bi bi-gender-female"></i> Betina
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                <i class="bi bi-question-circle"></i> Tidak Diketahui
                            </span>
                        @endif
                    </td>
                    <td>{{ $p->nama_pemilik ?? '-' }}</td>
                    <td>{{ $p->no_wa ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('perawat.pasien.show', $p->idpet) }}" 
                           class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="8" class="text-center text-muted py-4">
                        Tidak ada data pasien ditemukan
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($pasien->hasPages())
    <div class="card-footer clearfix">
        {{ $pasien->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

@endsection