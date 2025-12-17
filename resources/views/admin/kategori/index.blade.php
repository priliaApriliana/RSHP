@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')
<style>
    .page-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 4px 12px rgba(57, 88, 134, 0.15);
    }

    .page-header h2 {
        color: #ffffff;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    .btn-add-new {
        background: #ffffff;
        color: #395886;
        padding: 0.625rem 1.5rem;
        border-radius: 10px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-add-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        color: #395886;
    }

    .content-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
        overflow: hidden;
    }

    .search-section {
        padding: 1.5rem;
        background: linear-gradient(to bottom, #F0F3FA 0%, #ffffff 100%);
        border-bottom: 2px solid #D5DEEF;
    }

    .search-wrapper {
        position: relative;
        max-width: 450px;
    }

    .search-box input {
        padding: 0.5rem 0.75rem 0.5rem 2.5rem;
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        font-size: 0.875rem;
        width: 100%;
    }

    .search-box i {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #628ECB;
    }

    /* ===== TABLE WITH BORDERS ===== */
    .table-container {
        overflow-x: auto;
        border: 1px solid #D5DEEF;
        border-radius: 0 0 16px 16px;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        background: linear-gradient(to right, #F0F3FA 0%, #F8FAFC 100%);
        padding: 1rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #395886;
        text-transform: uppercase;
        border: 1px solid #D5DEEF;
        text-align: center;
    }

    .data-table tbody td {
        padding: 1.1rem 1.5rem;
        font-size: 0.875rem;
        color: #395886;
        border: 1px solid #D5DEEF;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: linear-gradient(to right, #F8FAFC 0%, #F0F3FA 100%);
    }

    .row-number {
        font-weight: 600;
        color: #628ECB;
        text-align: center;
    }

    .kategori-name {
        font-weight: 600;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
    }

    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s ease;
    }

    .btn-edit {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        color: #ffffff;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
        color: #ffffff;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        color: #ffffff;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state i {
        font-size: 2.5rem;
        color: #8AAEE0;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Kategori</h2>
                <p>Kelola dan pantau data kategori layanan</p>
            </div>
            <a href="{{ route('admin.kategori.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kategori
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-card">

        {{-- SEARCH --}}
        <div class="search-section">
            <div class="search-wrapper">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchInput" placeholder="Cari nama kategori...">
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Nama Kategori</th>
                        <th width="220">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($kategori as $no => $k)
                    <tr>
                        <td class="row-number">{{ $no + 1 }}</td>
                        <td class="kategori-name">{{ $k->nama_kategori }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i>Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3">
                            <div class="empty-state">
                                <i class="bi bi-inbox"></i>
                                <h5>Belum Ada Data</h5>
                                <p>Data kategori belum tersedia</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>

@endsection
