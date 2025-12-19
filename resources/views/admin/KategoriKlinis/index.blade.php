@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori Klinis</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {!! session('success') !!}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {!! session('error') !!}
    </div>
    @endif

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
