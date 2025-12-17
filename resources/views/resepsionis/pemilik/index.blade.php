@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pemilik</li>
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

    /* Text Styling */
    .text-owner-name {
        color: var(--dark-blue);
        font-weight: 600;
        font-size: 1rem;
    }

    .text-owner-info {
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

    /* Icon Styling */
    .icon-primary {
        color: var(--primary-blue);
    }

    .icon-light {
        color: var(--light-blue);
    }

    /* Contact Info Styling */
    .contact-info {
        display: flex;
        align-items: center;
        color: var(--primary-blue);
    }

    .contact-info i {
        margin-right: 0.5rem;
        color: var(--light-blue);
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <!-- Header Card -->
            <div class="card card-custom mb-4">
                <div class="card-header-custom">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                        <div>
                            <h3>
                                <i class="bi bi-people me-2"></i> Daftar Pemilik
                            </h3>
                            <p class="mb-0">Kelola data pemilik pet</p>
                        </div>
                        <a href="{{ route('resepsionis.pemilik.create') }}" class="btn btn-custom-primary">
                            <i class="bi bi-plus me-2"></i> Tambah Pemilik
                        </a>
                    </div>
                </div>
            </div>

            <!-- Main Content Card -->
            <div class="card card-custom">
                <div class="card-body">
                    <!-- Alert Messages -->
                    @if(session('success'))
                        <div class="alert alert-custom-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-custom-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- Table -->
                    <div class="table-responsive">
                        <table class="table table-hover table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="width: 10%;">
                                        <i class="bi bi-hash me-2"></i>ID
                                    </th>
                                    <th>
                                        <i class="bi bi-person me-2"></i>Nama
                                    </th>
                                    <th>
                                        <i class="bi bi-envelope me-2"></i>Email
                                    </th>
                                    <th>
                                        <i class="bi bi-phone me-2"></i>No. WA
                                    </th>
                                    <th>
                                        <i class="bi bi-geo-alt me-2"></i>Alamat
                                    </th>
                                    <th style="width: 15%; text-align: center;">
                                        <i class="bi bi-gear me-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pemilik as $p)
                                <tr>
                                    <td>
                                        <span class="badge badge-custom-id">{{ $p->idpemilik }}</span>
                                    </td>
                                    <td>
                                        <span class="text-owner-name">
                                            <i class="bi bi-person-circle me-2 icon-light"></i>{{ $p->nama }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="contact-info">
                                            <i class="bi bi-envelope"></i>
                                            <span>{{ $p->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="contact-info">
                                            <i class="bi bi-whatsapp"></i>
                                            <span>{{ $p->no_wa }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <small class="text-muted d-block"
                                            style="max-width: 220px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            <i class="bi bi-geo-alt me-1 icon-light"></i>
                                            {{ $p->alamat }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('resepsionis.pemilik.show', $p->idpemilik) }}" 
                                               class="btn btn-sm btn-action btn-action-view" 
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('resepsionis.pemilik.edit', $p->idpemilik) }}" 
                                               class="btn btn-sm btn-warning btn-action" 
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('resepsionis.pemilik.destroy', $p->idpemilik) }}" 
                                                  method="POST" 
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger btn-action" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data pemilik ini?')" 
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6">
                                        <div class="empty-state">
                                            <i class="bi bi-inbox"></i>
                                            <p class="mb-1">Tidak ada data pemilik</p>
                                            <small class="text-muted">Klik tombol "Tambah Pemilik" untuk menambahkan data</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($pemilik->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pemilik->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection