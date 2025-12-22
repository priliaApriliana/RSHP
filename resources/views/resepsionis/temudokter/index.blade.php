@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Temu Dokter</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/resepsionis/index.css') }}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i><strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <div class="card card-custom mb-4">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h3>
                                <i class="bi bi-calendar-check me-2"></i> Daftar Temu Dokter
                            </h3>
                            <p class="mb-0">Kelola jadwal kunjungan pasien ke dokter</p>
                        </div>
                        <a href="{{ route('resepsionis.temudokter.create') }}" class="btn btn-custom-primary">
                            <i class="bi bi-plus me-2"></i> Tambah Temu Dokter
                        </a>
                    </div>
                </div>
            </div>

            <div class="card card-custom">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 8%;"><i class="bi bi-hash me-2"></i>No. Urut</th>
                                    <th style="width: 14%;"><i class="bi bi-calendar me-2"></i>Waktu Daftar</th>
                                    <th><i class="bi bi-paw me-2"></i>Nama Hewan</th>
                                    <th><i class="bi bi-person me-2"></i>Nama Pemilik</th>
                                    <th><i class="bi bi-person-badge me-2"></i>Nama Dokter</th>
                                    <th style="width: 10%;"><i class="bi bi-info-circle me-2"></i>Status</th>
                                    <th style="width: 12%; text-align: center;"><i class="bi bi-gear me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($temuDokter as $item)
                                    <tr>
                                        <td>
                                            <span class="badge badge-custom-id">{{ $item->no_urut }}</span>
                                        </td>
                                        <td>
                                            <div class="datetime-info">
                                                <i class="far fa-clock me-2" style="color: var(--light-blue);"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->waktu_daftar)->format('d-m-Y') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-pet-name">
                                                <i class="bi bi-heart me-2" style="color: var(--light-blue);"></i>{{ $item->nama_hewan }}
                                            </span>
                                        </td>
                                        <td>{{ $item->nama_pemilik }}</td>
                                        <td>
                                            <i class="bi bi-stethoscope me-2" style="color: var(--light-blue);"></i>{{ $item->nama_dokter }}
                                        </td>
                                        <td>
                                            {{-- ✅ STATUS DINAMIS --}}
                                            @if($item->status_display == 'A')
                                                <span class="badge badge-status" style="background-color: #17a2b8; color: #fff;">
                                                    <i class="bi bi-clock"></i> ANTRI
                                                </span>
                                            @elseif($item->status_display == 'P')
                                                <span class="badge badge-status" style="background-color: #ffc107; color: #000;">
                                                    <i class="bi bi-hourglass-split"></i> PROSES
                                                </span>
                                            @elseif($item->status_display == 'S')
                                                <span class="badge badge-status" style="background-color: #28a745; color: #fff;">
                                                    <i class="bi bi-check-circle"></i> SELESAI
                                                </span>
                                            @elseif($item->status_display == 'B')
                                                <span class="badge badge-status" style="background-color: #dc3545; color: #fff;">
                                                    <i class="bi bi-x-circle"></i> BATAL
                                                </span>
                                            @else
                                                <span class="badge badge-secondary">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('resepsionis.temudokter.show', $item->idreservasi_dokter) }}" 
                                                   class="btn btn-sm btn-action btn-action-view" title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('resepsionis.temudokter.edit', $item->idreservasi_dokter) }}" 
                                                   class="btn btn-sm btn-warning btn-action" title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                @if(in_array($item->status_display, ['A', 'P']))
                                                <form action="{{ route('resepsionis.temudokter.batal', $item->idreservasi_dokter) }}" 
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger btn-action"
                                                            onclick="return confirm('Yakin ingin membatalkan temu dokter ini?')" title="Batalkan">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="text-center py-5">
                                                <i class="bi bi-inbox" style="font-size: 3rem; color: var(--lightest-blue);"></i>
                                                <p class="mt-3 mb-0">Tidak ada data temu dokter</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($temuDokter->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $temuDokter->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection