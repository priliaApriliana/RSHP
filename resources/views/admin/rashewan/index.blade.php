@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ras Hewan</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Ras Hewan</h2>
                <p>Kelola dan pantau data ras hewan dalam sistem</p>
            </div>
            <a href="{{ route('admin.rashewan.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle me-2"></i>Tambah Ras Hewan
            </a>
        </div>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
        {{-- Search Section --}}
        <div class="search-section">
            <div class="search-wrapper">
                <div class="search-box">
                    <i class="bi bi-search"></i>
                    <input type="text" 
                           id="searchInput" 
                           placeholder="Cari berdasarkan nama ras atau jenis hewan...">
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">No</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th style="width: 200px;" class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @forelse ($rasHewan as $ras)
                    <tr>
                        <td class="row-number text-center">{{ $loop->iteration }}</td>
                        <td class="ras-name">{{ $ras->nama_ras }}</td>
                        <td>
                            <span class="jenis-badge">{{ $ras->nama_jenis_hewan ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.rashewan.edit', $ras->idras_hewan) }}" 
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.rashewan.destroy', $ras->idras_hewan) }}"
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
                                <p>Belum ada data ras hewan yang tersedia</p>
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

            // Search in nama ras and jenis hewan columns
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