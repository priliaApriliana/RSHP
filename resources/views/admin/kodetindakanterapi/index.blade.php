@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kode Tindakan Terapi</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        {!! session('success') !!}  
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show">
        {!! session('error') !!}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    @endif
    
    {{-- Page Header --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <div>
                <h2>Data Kode Tindakan Terapi</h2>
                <p>Kelola dan pantau data kode tindakan terapi dalam sistem</p>
            </div>
            <a href="{{ route('admin.kodetindakanterapi.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle me-2"></i>Tambah Kode Tindakan
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
                           placeholder="Cari berdasarkan kode, deskripsi, atau kategori...">
                </div>
            </div>
        </div>

        {{-- Table Section --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 70px">No</th>
                        <th style="width: 100px">ID</th>
                        <th style="width: 120px">Kode</th>
                        <th>Nama Tindakan Terapi</th>
                        <th style="width: 140px">Kategori</th>
                        <th style="width: 140px">Kategori Klinis</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>

                <tbody id="tableBody">
                    @forelse ($kodeTindakan as $index => $k)
                    <tr>
                        <td class="row-number text-center">{{ $index + 1 }}</td>
                        <td class="text-center">
                            <span class="id-badge">{{ $k->idkode_tindakan_terapi }}</span>
                        </td>
                        <td class="text-center">
                            <span class="kode-text">{{ $k->kode }}</span>
                        </td>
                        <td>{{ $k->deskripsi_tindakan_terapi }}</td>
                        <td class="text-center">
                            <span class="kategori-badge">{{ $k->nama_kategori ?? '-' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="kategori-badge">{{ $k->nama_kategori_klinis ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.kodetindakanterapi.edit', $k->idkode_tindakan_terapi) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil-square"></i>
                                    Edit
                                </a>

                                <form action="{{ route('admin.kodetindakanterapi.destroy', $k->idkode_tindakan_terapi) }}"
                                      method="POST"
                                      style="margin: 0;"
                                      onsubmit="return confirm('Hapus data ini?')">
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
                        <td colspan="7">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-inbox"></i>
                                </div>
                                <h5>Belum Ada Data</h5>
                                <p>Belum ada data kode tindakan terapi yang tersedia</p>
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

            // Search in kode, deskripsi, and kategori columns (index 2, 3, 4, 5)
            for (let j = 2; j <= 5; j++) {
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
                    <td colspan="7">
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