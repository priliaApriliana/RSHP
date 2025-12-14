@extends('layouts.lte.main')

@section('page-title', 'Daftar Temu Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Temu Dokter</li>
@endsection

@section('content')

<style>
    :root {
        --primary-blue: #628ECB;
        --light-blue: #8AAEE0;
        --lighter-blue: #B1C9EF;
        --lightest-blue: #D5DEEF;
        --very-light-blue: #F0F3FA;
        --dark-blue: #395886;
    }

    /* Header Card Styling */
    .card-header-custom {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: white;
        border-radius: 0.5rem 0.5rem 0 0;
        padding: 1.25rem 1.5rem;
    }

    .card-header-custom h3 {
        margin: 0;
        font-weight: 600;
        font-size: 1.5rem;
    }

    .card-header-custom p {
        margin: 0.5rem 0 0 0;
        opacity: 0.95;
        font-size: 0.9rem;
    }

    /* Button Styling */
    .btn-custom-primary {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        border: none;
        color: white;
        padding: 0.5rem 1.25rem;
        border-radius: 0.375rem;
        font-weight: 500;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.3);
    }

    .btn-custom-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.4);
        color: white;
    }

    /* Card Styling */
    .card-custom {
        border: none;
        box-shadow: 0 2px 15px rgba(98, 142, 203, 0.1);
        border-radius: 0.5rem;
    }

    /* Table Styling */
    .table-custom thead th {
        background-color: var(--very-light-blue);
        color: var(--dark-blue);
        font-weight: 600;
        border-bottom: 2px solid var(--lightest-blue);
        padding: 1rem;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-custom tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid var(--very-light-blue);
    }

    .table-custom tbody tr:hover {
        background-color: var(--very-light-blue);
        transform: scale(1.002);
    }

    .table-custom tbody td {
        padding: 1rem;
        vertical-align: middle;
    }

    /* Badge Styling */
    .badge-custom-id {
        background: linear-gradient(135deg, var(--light-blue) 0%, var(--primary-blue) 100%);
        color: white;
        padding: 0.4rem 0.75rem;
        border-radius: 0.375rem;
        font-weight: 600;
        font-size: 0.8rem;
    }

    .badge-status {
        padding: 0.4rem 0.85rem;
        border-radius: 1rem;
        font-weight: 500;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .badge-aktif {
        background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
        color: white;
        box-shadow: 0 2px 6px rgba(98, 142, 203, 0.3);
    }

    .badge-selesai {
        background-color: rgba(138, 174, 224, 0.25);
        color: var(--primary-blue);
        border: 1px solid var(--light-blue);
    }

    .badge-batal {
        background-color: rgba(220, 53, 69, 0.1);
        color: #dc3545;
        border: 1px solid #dc3545;
    }

    /* Text Styling */
    .text-pet-name {
        color: var(--dark-blue);
        font-weight: 600;
        font-size: 1rem;
    }

    .text-appointment-info {
        color: var(--primary-blue);
    }

    /* Alert Styling */
    .alert-custom-success {
        background-color: rgba(138, 174, 224, 0.15);
        border-left: 4px solid var(--primary-blue);
        color: var(--dark-blue);
        border-radius: 0.375rem;
    }

    .alert-custom-danger {
        background-color: rgba(220, 53, 69, 0.1);
        border-left: 4px solid #dc3545;
        color: #721c24;
        border-radius: 0.375rem;
    }

    /* Action Buttons */
    .btn-action {
        padding: 0.375rem 0.6rem;
        border-radius: 0.25rem;
        transition: all 0.2s ease;
        border: none;
        margin: 0 0.1rem;
    }

    .btn-action:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .btn-action-view {
        background-color: var(--light-blue);
        color: white;
    }

    .btn-action-view:hover {
        background-color: var(--primary-blue);
        color: white;
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem 1rem;
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--lightest-blue);
        opacity: 0.6;
    }

    .empty-state p {
        color: var(--light-blue);
        margin-top: 1rem;
        font-size: 1rem;
    }

    /* DateTime Styling */
    .datetime-info {
        display: flex;
        align-items: center;
        color: var(--primary-blue);
    }

    .datetime-info i {
        margin-right: 0.5rem;
        color: var(--light-blue);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <!-- Alert Messages -->
            @if (session('success'))
                <div class="alert alert-custom-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-custom-danger alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-exclamation-circle me-2"></i><strong>Gagal!</strong> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Header Card -->
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

            <!-- Main Content Card -->
            <div class="card card-custom">
                <div class="card-body">
                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 8%;">
                                        <i class="bi bi-hash me-2"></i>No. Urut
                                    </th>
                                    <th style="width: 14%;">
                                        <i class="bi bi-calendar me-2"></i>Waktu Daftar
                                    </th>
                                    <th>
                                        <i class="bi bi-paw me-2"></i>Nama Hewan
                                    </th>
                                    <th>
                                        <i class="bi bi-person me-2"></i>Nama Pemilik
                                    </th>
                                    <th>
                                        <i class="bi bi-person-badge me-2"></i>Nama Dokter
                                    </th>
                                    <th style="width: 10%;">
                                        <i class="bi bi-info-circle me-2"></i>Status
                                    </th>
                                    <th style="width: 12%; text-align: center;">
                                        <i class="bi bi-gear me-2"></i>Aksi
                                    </th>
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
                                                <i class="far fa-clock"></i>
                                                <span>{{ \Carbon\Carbon::parse($item->waktu_daftar)->format('d/m/Y H:i') }}</span>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-pet-name">
                                                <i class="bi bi-heart me-2" style="color: var(--light-blue);"></i>{{ $item->nama_hewan }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="text-appointment-info">{{ $item->nama_pemilik }}</span>
                                        </td>
                                        <td>
                                            <span class="text-appointment-info">
                                                <i class="bi bi-stethoscope me-2" style="color: var(--light-blue);"></i>{{ $item->nama_dokter }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($item->status == 'A')
                                                <span class="badge badge-status badge-aktif">
                                                    <i class="bi bi-circle-notch me-1"></i>Aktif
                                                </span>
                                            @elseif($item->status == 'S')
                                                <span class="badge badge-status badge-selesai">
                                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                                </span>
                                            @elseif($item->status == 'B')
                                                <span class="badge badge-status badge-batal">
                                                    <i class="bi bi-times-circle me-1"></i>Batal
                                                </span>
                                            @else
                                                <span class="badge badge-status bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('resepsionis.temudokter.show', $item->idreservasi_dokter) }}" 
                                                   class="btn btn-sm btn-action btn-action-view" 
                                                   title="Lihat Detail">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="{{ route('resepsionis.temudokter.edit', $item->idreservasi_dokter) }}" 
                                                   class="btn btn-sm btn-warning btn-action" 
                                                   title="Edit">
                                                    <i class="bi bi-pencil-square"></i>
                                                </a>
                                                <form action="{{ route('resepsionis.temudokter.destroy', $item->idreservasi_dokter) }}" 
                                                      method="POST" 
                                                      style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger btn-action" 
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus data temu dokter ini?')" 
                                                            title="Hapus">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7">
                                            <div class="empty-state">
                                                <i class="bi bi-inbox"></i>
                                                <p class="mb-1">Tidak ada data temu dokter</p>
                                                <small class="text-muted">Klik tombol "Tambah Temu Dokter" untuk menambahkan jadwal</small>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($temuDokter->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $temuDokter->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection