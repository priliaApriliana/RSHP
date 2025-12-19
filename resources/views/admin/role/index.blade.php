@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Role</li>
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
                <h2>Daftar Role</h2>
                <p>Kelola dan pantau data role dalam sistem</p>
            </div>
            <a href="{{ route('admin.role.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle me-2"></i>Tambah Role
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
                       placeholder="Cari berdasarkan ID atau nama role...">
            </div>
        </div>

        {{-- Table --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 150px">ID Role</th>
                        <th>Nama Role</th>
                        <th style="width: 200px" class="text-center">Aksi</th>
                    </tr>
                </thead>

                {{-- ⬇️ ID DITAMBAHKAN (WAJIB) --}}
                <tbody id="tableBody">
                    @forelse ($role as $r)
                        <tr>
                            <td>
                                <span class="id-badge">{{ $r->idrole }}</span>
                            </td>
                            <td>
                                <span class="role-name">{{ $r->nama_role }}</span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.role.edit', $r->idrole) }}"
                                       class="btn-action btn-edit">
                                        <i class="bi bi-pencil-square"></i>
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.role.destroy', $r->idrole) }}"
                                          method="POST"
                                          onsubmit="return confirm('Yakin ingin menghapus role ini?')">
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
                            <td colspan="3">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="bi bi-inbox"></i>
                                    </div>
                                    <h5>Belum Ada Data</h5>
                                    <p>Belum ada data role yang tersedia</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- ================= SEARCH SCRIPT ================= --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('searchInput');
    const tableBody  = document.getElementById('tableBody');

    searchInput.addEventListener('keyup', function () {

        const keyword = this.value.toLowerCase();
        const rows = tableBody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {
            if (row.id === 'emptyRow' || row.id === 'noResultRow') return;

            const text = row.innerText.toLowerCase();

            if (text.includes(keyword)) {
                row.style.display = '';
                visibleCount++;
            } else {
                row.style.display = 'none';
            }
        });

        const noResultRow = document.getElementById('noResultRow');

        if (visibleCount === 0 && keyword !== '') {
            if (!noResultRow) {
                const tr = document.createElement('tr');
                tr.id = 'noResultRow';
                tr.innerHTML = `
                    <td colspan="3">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5>Tidak Ada Hasil</h5>
                            <p>Data dengan kata "<b>${keyword}</b>" tidak ditemukan</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(tr);
            }
        } else {
            if (noResultRow) noResultRow.remove();
        }
    });
});
</script>

@endsection
