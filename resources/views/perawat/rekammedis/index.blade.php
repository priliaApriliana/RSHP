@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rekam Medis</li>
@endsection

{{-- Load CSS Khusus Halaman Rekam Medis --}}
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/perawat/index.css') }}">
@endsection

@section('content')
{{-- Alert Messages --}}
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

{{-- Search Card --}}
<div class="card search-card">
    <div class="card-body">
        <form method="GET" action="{{ route('perawat.rekammedis.index') }}">
            <div class="row g-2">
                <div class="col-md-10 col-sm-8">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}"
                           placeholder="Cari nama hewan, pemilik, atau diagnosa..."
                           class="form-control">
                </div>
                <div class="col-md-2 col-sm-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-search"></i> Cari
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Table Card --}}
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><i class="bi bi-clipboard-list"></i> Daftar Rekam Medis</h3>
        <div class="card-tools">
            <a href="{{ route('perawat.rekammedis.create') }}" class="btn btn-create btn-sm">
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
                        <i class="bi bi-inbox"></i>
                        <p>Tidak ada data rekam medis ditemukan</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($rekam->hasPages())
    <div class="card-footer clearfix">
        {{ $rekam->links('pagination::bootstrap-4') }}
    </div>
    @endif
</div>
@endsection

{{-- JavaScript Khusus Halaman Ini --}}
@section('scripts')
<script>
$(document).ready(function() {
    // Tooltip initialization
    $('[data-toggle="tooltip"]').tooltip();
    
    // Auto hide alerts after 5 seconds
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endsection