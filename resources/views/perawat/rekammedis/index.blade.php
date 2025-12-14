@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Rekam Medis</li>
@endsection

@section('content')

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

<div class="card mb-4">
    <div class="card-body">
        <form method="GET" action="{{ route('perawat.rekammedis.index') }}">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" 
                           name="q" 
                           value="{{ request('q') }}"
                           placeholder="Cari diagnosa atau nama pet..."
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

<div class="card">
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
                    <th>Tanggal</th>
                    <th>Nama Hewan</th>
                    <th>Pemilik</th>
                    <th>Diagnosa</th>
                    <th class="text-center" style="width: 150px;">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($rekam as $i => $rm)
                <tr>
                    <td class="text-center">{{ $rekam->firstItem() + $i }}</td>
                    <td>{{ \Carbon\Carbon::parse($rm->created_at)->format('d/m/Y H:i') }}</td>
                    <td><strong>{{ $rm->nama_hewan }}</strong></td>
                    <td>{{ $rm->nama_pemilik }}</td>
                    <td>{{ Str::limit($rm->diagnosa, 50) }}</td>

                    <td class="text-center">
                        <div class="btn-group btn-group-sm" role="group">
                            
                            <!-- Pakai Bootstrap Icons -->
                            <a href="{{ route('perawat.rekammedis.show', $rm->idrekam_medis) }}" 
                            class="btn btn-info btn-sm"
                            data-bs-toggle="tooltip"
                            title="Detail">
                                <i class="bi bi-eye"></i>
                            </a>

                            <a href="{{ route('perawat.rekammedis.edit', $rm->idrekam_medis) }}" 
                            class="btn btn-warning btn-sm"
                            data-bs-toggle="tooltip"
                            title="Edit">
                                <i class="bi bi-pencil"></i>
                            </a>

                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-4">
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
    // Aktifkan tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // Auto dismiss alert setelah 5 detik
    setTimeout(function() {
        $('.alert').fadeOut('slow');
    }, 5000);
});
</script>
@endpush