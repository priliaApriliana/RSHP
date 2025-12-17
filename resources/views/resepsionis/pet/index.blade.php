@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pet</li>
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

    .badge-custom-gender {
        padding: 0.4rem 0.85rem;
        border-radius: 1rem;
        font-weight: 500;
        font-size: 0.8rem;
    }

    .badge-jantan {
        background-color: rgba(138, 174, 224, 0.2);
        color: var(--primary-blue);
        border: 1px solid var(--light-blue);
    }

    .badge-betina {
        background-color: rgba(213, 222, 239, 0.3);
        color: var(--dark-blue);
        border: 1px solid var(--lighter-blue);
    }

    /* Text Styling */
    .text-pet-name {
        color: var(--dark-blue);
        font-weight: 600;
        font-size: 1rem;
    }

    .text-pet-info {
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
                                <i class="bi bi-heart me-2"></i> Daftar Pet
                            </h3>
                            <p class="mb-0">Kelola data hewan peliharaan</p>
                        </div>
                        <a href="{{ route('resepsionis.pet.create') }}" class="btn btn-custom-primary">
                            <i class="bi bi-plus me-2"></i> Tambah Pet
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
                                    <th style="width: 8%;">
                                        <i class="bi bi-hash me-2"></i>ID
                                    </th>
                                    <th>
                                        <i class="bi bi-heart-fill me-2"></i>Nama Hewan
                                    </th>
                                    <th>
                                        <i class="bi bi-person me-2"></i>Pemilik
                                    </th>
                                    <th>
                                        <i class="bi bi-tags me-2"></i>Jenis Hewan
                                    </th>
                                    <th>
                                        <i class="bi bi-list me-2"></i>Ras
                                    </th>
                                    <th style="width: 11%;">
                                        <i class="bi bi-gender-male me-2"></i>Kelamin
                                    </th>
                                    <th style="width: 12%;">
                                        <i class="bi bi-calendar me-2"></i>Lahir
                                    </th>
                                    <th style="width: 15%; text-align: center;">
                                        <i class="bi bi-gear me-2"></i>Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pet as $p)
                                <tr>
                                    <td>
                                        <span class="badge badge-custom-id">{{ $p->idpet }}</span>
                                    </td>
                                    <td>
                                        <span class="text-pet-name">{{ $p->nama }}</span>
                                    </td>
                                    <td>
                                        <span class="text-pet-info">{{ $p->nama_pemilik }}</span>
                                    </td>
                                    <td>
                                        <span class="text-pet-info">{{ $p->nama_jenis_hewan }}</span>
                                    <td>
                                        <span class="text-pet-info">{{ $p->nama_ras }}</span>
                                    </td>
                                    <td>
                                        <span class="badge badge-custom-gender {{ $p->jenis_kelamin == 'J' ? 'badge-jantan' : 'badge-betina' }}">
                                            <i class="bi bi-{{ $p->jenis_kelamin == 'J' ? 'gender-male' : 'gender-female' }} me-1"></i>
                                            {{ $p->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-pet-info">
                                            <i class="far fa-calendar me-1"></i>
                                            {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d/m/Y') }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group">
                                            <a href="{{ route('resepsionis.pet.show', $p->idpet) }}" 
                                               class="btn btn-sm btn-action btn-action-view" 
                                               title="Lihat Detail">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            <a href="{{ route('resepsionis.pet.edit', $p->idpet) }}" 
                                               class="btn btn-sm btn-warning btn-action" 
                                               title="Edit">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <form action="{{ route('resepsionis.pet.destroy', $p->idpet) }}" 
                                                  method="POST" 
                                                  style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn btn-sm btn-danger btn-action" 
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus data pet ini?')" 
                                                        title="Hapus">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="8">
                                        <div class="empty-state">
                                            <i class="fas fa-inbox"></i>
                                            <p class="mb-1">Tidak ada data pet</p>
                                            <small class="text-muted">Klik tombol "Tambah Pet" untuk menambahkan data</small>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($pet->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $pet->links('pagination::bootstrap-5') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection