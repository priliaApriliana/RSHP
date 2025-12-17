@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ras Hewan</li>
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
        letter-spacing: -0.5px;
    }
    
    .page-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.875rem;
        margin: 0.5rem 0 0 0;
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
        border-bottom: 1px solid #D5DEEF;
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
        transition: all 0.3s ease;
        background: #ffffff;
        width: 100%;
    }
    
    .search-box input:focus {
        border-color: #8AAEE0;
        background: #ffffff;
        box-shadow: 0 0 0 3px rgba(138, 174, 224, 0.1);
        outline: none;
    }
    
    .search-box i {
        position: absolute;
        left: 0.875rem;
        top: 50%;
        transform: translateY(-50%);
        color: #628ECB;
        font-size: 0.875rem;
    }
    
    .table-container {
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        margin: 0;
    }
    
    .data-table thead {
        background: linear-gradient(to right, #F0F3FA 0%, #F8FAFC 100%);
        border-bottom: 2px solid #D5DEEF;
    }
    
    .data-table thead th {
        padding: 1.125rem 1.5rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #395886;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        border: none;
    }
    
    .data-table tbody td {
        padding: 1.25rem 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid #F0F3FA;
        font-size: 0.875rem;
        color: #395886;
    }
    
    .data-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .data-table tbody tr:hover {
        background: linear-gradient(to right, #F8FAFC 0%, #F0F3FA 100%);
        transform: scale(1.001);
    }
    
    .row-number {
        font-weight: 600;
        color: #628ECB;
    }
    
    .ras-name {
        font-weight: 600;
        color: #395886;
    }
    
    .jenis-badge {
        display: inline-block;
        padding: 0.375rem 0.875rem;
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
        color: #395886;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.8125rem;
    }
    
    .action-buttons {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        align-items: center;
    }
    
    .btn-action {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }
    
    .btn-edit {
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        color: #ffffff;
    }
    
    .btn-edit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(98, 142, 203, 0.3);
        color: #ffffff;
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
        color: #ffffff;
    }
    
    .btn-delete:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(214, 48, 49, 0.3);
        color: #ffffff;
    }
    
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }
    
    .empty-state-icon {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem;
        background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
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
        font-size: 1.125rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .empty-state p {
        color: #628ECB;
        font-size: 0.875rem;
        margin: 0;
    }
</style>

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