@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Jenis Hewan</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    {{-- ALERT NOTIFICATION --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Berhasil!</strong>
                <p>{{ session('success') }}</p>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Gagal!</strong>
                <p>{{ session('error') }}</p>
            </div>
        @endif

    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Jenis Hewan</h2>
                <p>Kelola dan pantau data jenis hewan dalam sistem</p>
            </div>
            <a href="{{ route('admin.jenishewan.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle me-2"></i>Tambah Jenis Hewan
            </a>
        </div>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
        {{-- Search Section --}}
        <div class="search-section">
            <div class="search-wrapper">
                <i class="bi bi-search search-icon"></i>
                <input type="text" 
                       id="searchInput" 
                       class="search-input" 
                       placeholder="Cari berdasarkan ID atau nama jenis hewan...">
            </div>
        </div>

        {{-- Table Section --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px;">No</th>
                        <th style="width: 120px;">ID Jenis</th>
                        <th>Nama Jenis Hewan</th>
                        <th style="width: 200px;" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @forelse ($jenisHewan as $index => $item)
                        <tr>
                            <td class="row-number">{{ $index + 1 }}</td>
                            <td>
                                <span class="id-badge">{{ $item->idjenis_hewan }}</span>
                            </td>
                            <td class="animal-name">{{ $item->nama_jenis_hewan }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.jenishewan.edit', $item->idjenis_hewan) }}" 
                                       class="btn-action btn-edit">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.jenishewan.destroy', $item->idjenis_hewan) }}" 
                                          method="POST" 
                                          style="margin: 0;"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete">
                                            <i class="bi bi-trash"></i>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr id="emptyRow">
                            <td colspan="4">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Data</h5>
                                    <p>Belum ada data jenis hewan yang tersedia</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('tableBody');
    const rows = tableBody.getElementsByTagName('tr');

    searchInput.addEventListener('keyup', function() {
        const searchTerm = this.value.toLowerCase();
        let visibleCount = 0;

        for (let i = 0; i < rows.length; i++) {
            if (rows[i].id === 'emptyRow' || rows[i].id === 'noResultRow') continue;

            const cells = rows[i].getElementsByTagName('td');
            let found = false;

            for (let j = 1; j < 3; j++) {
                if (cells[j]) {
                    const text = cells[j].textContent.toLowerCase();
                    if (text.includes(searchTerm)) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                rows[i].style.display = '';
                visibleCount++;
            } else {
                rows[i].style.display = 'none';
            }
        }

        const noResultRow = document.getElementById('noResultRow');
        
        if (visibleCount === 0 && searchTerm !== '') {
            if (!noResultRow) {
                const newRow = document.createElement('tr');
                newRow.id = 'noResultRow';
                newRow.innerHTML = `
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5>Tidak Ada Hasil</h5>
                            <p>Tidak ditemukan data untuk pencarian "${searchTerm}"</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(newRow);
            }
        } else {
            if (noResultRow) {
                noResultRow.remove();
            }
        }
    });
});
</script>

@endsection