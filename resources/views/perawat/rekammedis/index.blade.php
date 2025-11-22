@extends('layouts.lte.main')

@section('page-title', 'Rekam Medis')

@section('content')

<div class="container-fluid mt-3">

    <!-- Judul Halaman -->
    <p class="text-muted">Kelola rekam medis pasien hewan</p>

    <!-- Card Filter -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">

            <form method="GET" action="{{ route('perawat.rekammedis.index') }}">

                <div class="row g-3">

                    <!-- Search -->
                    <div class="col-md-4">
                        <label class="form-label">Cari</label>
                        <input type="text" name="q" value="{{ request('q') }}"
                               placeholder="Nama pet, pemilik, atau diagnosa..."
                               class="form-control">
                    </div>

                    <!-- Tanggal Dari -->
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Dari</label>
                        <input type="date" name="from" value="{{ request('from') }}"
                               class="form-control">
                    </div>

                    <!-- Tanggal Sampai -->
                    <div class="col-md-3">
                        <label class="form-label">Tanggal Sampai</label>
                        <input type="date" name="to" value="{{ request('to') }}"
                               class="form-control">
                    </div>

                    <!-- Tombol Filter -->
                    <div class="col-md-2 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-funnel-fill"></i> Filter
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>

    <!-- Tabel Rekam Medis -->
    <div class="card shadow-sm">
        <div class="card-header">
            <strong>Daftar Rekam Medis</strong>
        </div>

        <div class="card-body table-responsive">

            <table class="table table-hover table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th>Tanggal</th>
                        <th>Nama Pet</th>
                        <th>Pemilik</th>
                        <th>Diagnosa</th>
                        <th>Dokter</th>
                        <th>No. Reservasi</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($rekammedis as $i => $r)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $r->created_at->format('d M Y') }}</td>
                        <td>{{ $r->temu->pet->nama ?? '-' }}</td>
                        <td>{{ $r->temu->pet->pemilik->nama ?? '-' }}</td>
                        <td>{{ $r->diagnosa ?? '-' }}</td>
                        <td>{{ $r->dokter_pemeriksa ?? '-' }}</td>
                        <td>#{{ $r->temu->idtemu ?? '---' }}</td>

                        <td class="text-center">
                            <a href="{{ route('perawat.rekammedis.show', $r->idrekam_medis) }}"
                               class="btn btn-info btn-sm">
                                <i class="bi bi-eye-fill"></i>
                            </a>
                        </td>
                    </tr>

                    @empty
                    <tr>
                        <td colspan="8" class="text-center py-3 text-muted">
                            Tidak ada data rekam medis ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@endsection
