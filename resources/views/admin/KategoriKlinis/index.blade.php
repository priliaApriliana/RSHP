@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori Klinis</li>
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
        color: #fff;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .page-header p {
        color: rgba(255,255,255,.85);
        font-size: .875rem;
        margin-top: .5rem;
    }

    .btn-add-new {
        background: #fff;
        color: #395886;
        padding: .625rem 1.5rem;
        border-radius: 10px;
        font-size: .875rem;
        font-weight: 600;
        border: none;
        transition: .3s;
        box-shadow: 0 2px 8px rgba(0,0,0,.1);
    }

    .btn-add-new:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,.15);
        color: #395886;
    }

    .content-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(57,88,134,.08);
        overflow: hidden;
    }

    .search-section {
        padding: 1.5rem;
        background: linear-gradient(to bottom, #F0F3FA 0%, #fff 100%);
        border-bottom: 2px solid #D5DEEF;
    }

    .search-wrapper {
        position: relative;
        max-width: 450px;
    }

    .search-box input {
        padding: .5rem .75rem .5rem 2.5rem;
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        font-size: .875rem;
        width: 100%;
    }

    .search-box i {
        position: absolute;
        left: .875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #628ECB;
    }

    /* ===== TABLE ===== */
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
        background: linear-gradient(to right, #F0F3FA, #F8FAFC);
        padding: 1rem;
        font-size: .75rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #395886;
        border: 1px solid #D5DEEF;
        text-align: center;
    }

    .data-table tbody td {
        padding: 1rem;
        border: 1px solid #D5DEEF;
        font-size: .875rem;
        color: #395886;
        vertical-align: middle;
    }

    .data-table tbody tr:hover {
        background: linear-gradient(to right, #F8FAFC, #F0F3FA);
    }

    .row-number {
        font-weight: 600;
        color: #628ECB;
        text-align: center;
    }

    .kategori-name {
        font-weight: 600;
        color: #395886;
    }

    .action-buttons {
        display: flex;
        gap: .5rem;
        justify-content: center;
    }

    .btn-action {
        padding: .5rem 1rem;
        border-radius: 8px;
        font-size: .8125rem;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: .4rem;
        transition: .3s;
    }

    .btn-edit {
        background: linear-gradient(135deg, #8AAEE0, #628ECB);
        color: #fff;
    }

    .btn-delete {
        background: linear-gradient(135deg, #ff7675, #d63031);
        color: #fff;
    }

    .btn-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,.15);
        color: #fff;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #F0F3FA, #D5DEEF);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-state-icon i {
        font-size: 2.5rem;
        color: #8AAEE0;
    }

    .empty-state h5 {
        color: #395886;
        font-weight: 600;
    }

    .empty-state p {
        color: #628ECB;
        font-size: .875rem;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Kategori Klinis</h2>
                <p>Kelola dan pantau data kategori klinis dalam sistem</p>
            </div>
            <a href="{{ route('admin.kategoriklinis.create') }}" class="btn-add-new">
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
                    <input type="text" id="searchInput" placeholder="Cari kategori klinis...">
                </div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="80">No</th>
                        <th>Nama Kategori Klinis</th>
                        <th width="200">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($kategoriKlinis as $i => $k)
                    <tr>
                        <td class="row-number">{{ $i+1 }}</td>
                        <td class="kategori-name">{{ $k->nama_kategori_klinis }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kategoriklinis.edit',$k->idkategori_klinis) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>Edit
                                </a>
                                <form action="{{ route('admin.kategoriklinis.destroy',$k->idkategori_klinis) }}"
                                      method="POST"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete">
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
                                <div class="empty-state-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <h5>Belum Ada Data</h5>
                                <p>Data kategori klinis belum tersedia</p>
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
