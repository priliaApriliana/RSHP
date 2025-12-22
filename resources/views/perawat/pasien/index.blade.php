@extends('layouts.lte.main')

@section('page-title', 'Data Pasien')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pasien</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/perawat/index.css') }}">
@endsection

@section('content')

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