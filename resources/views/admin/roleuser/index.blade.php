@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen Role</li>
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
        <div>
            <h2>Manajemen Role User</h2>
            <p>Kelola dan atur role untuk setiap user dalam sistem</p>
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
                       placeholder="Cari berdasarkan ID, nama user, atau role...">
            </div>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 80px" class="text-center">ID</th>
                        <th style="width: 180px">Nama User</th>
                        <th style="width: 280px">Roles (Status)</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($users as $user)
                    <tr>
                        <td class="text-center">
                            <span class="user-id">{{ $user->iduser }}</span>
                        </td>
                        <td>
                            <span class="user-name">{{ $user->nama }}</span>
                        </td>
                        <td>
                            @if($user->roles->isEmpty())
                                <span class="role-badge empty">Belum ada role</span>
                            @else
                                @foreach($user->roles as $role)
                                    <span class="role-badge {{ $role->status == 1 ? 'active' : 'inactive' }}">
                                        {{ $role->nama_role }} ({{ $role->status == 1 ? 'aktif' : 'nonaktif' }})
                                    </span>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <div class="role-actions">
                                {{-- Tombol Tambah Role --}}
                                <div>
                                    <a href="{{ route('admin.roleuser.create', $user->iduser) }}" 
                                       class="btn-add-role">
                                        <i class="bi bi-plus-circle"></i> Tambahkan Role
                                    </a>
                                </div>

                                {{-- Daftar Role dengan Aksi --}}
                                @foreach($user->roles as $role)
                                    <div class="role-item">
                                        <span class="role-name">{{ $role->nama_role }}</span>
                                        
                                        <div class="btn-group-custom">
                                            {{-- Edit Status --}}
                                            <a href="{{ route('admin.roleuser.edit', $role->idrole_user) }}" 
                                               class="btn-action-sm btn-edit-sm"
                                               title="Edit Status">
                                                <i class="bi bi-pencil"></i> Edit
                                            </a>
                                            
                                            {{-- Hapus Role --}}
                                            <form action="{{ route('admin.roleuser.destroy', $role->idrole_user) }}"
                                                  method="POST" 
                                                  style="margin: 0;"
                                                  onsubmit="return confirm('Yakin hapus role {{ $role->nama_role }} dari user {{ $user->nama }}?')">
                                                @csrf 
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="btn-action-sm btn-delete-sm"
                                                        title="Hapus Role">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr id="emptyRow">
                        <td colspan="4">
                            <div class="empty-state">
                                <div class="empty-state-icon">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5>Tidak Ada Data User</h5>
                                <p>Belum ada data user yang tersedia</p>
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
    const tableBody = document.getElementById('tableBody');

    if (!searchInput || !tableBody) {
        console.error('Search input or table body not found');
        return;
    }

    searchInput.addEventListener('keyup', function () {
        const keyword = this.value.toLowerCase().trim();
        const rows = tableBody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {
            // Skip empty state dan no result row
            if (row.id === 'emptyRow' || row.id === 'noResultRow') {
                return;
            }

            // Ambil text dari kolom ID, Nama, dan Roles
            const cells = row.querySelectorAll('td');
            let searchText = '';
            
            // Gabungkan text dari kolom 0 (ID), 1 (Nama), 2 (Roles)
            if (cells[0]) searchText += cells[0].textContent.toLowerCase() + ' ';
            if (cells[1]) searchText += cells[1].textContent.toLowerCase() + ' ';
            if (cells[2]) searchText += cells[2].textContent.toLowerCase() + ' ';

            const match = searchText.includes(keyword);

            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        // Handle "no result" row
        let noResultRow = document.getElementById('noResultRow');

        if (visibleCount === 0 && keyword !== '') {
            if (!noResultRow) {
                noResultRow = document.createElement('tr');
                noResultRow.id = 'noResultRow';
                noResultRow.innerHTML = `
                    <td colspan="4">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5>Tidak Ada Hasil</h5>
                            <p>Data dengan kata kunci "<b>${keyword}</b>" tidak ditemukan</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(noResultRow);
            }
        } else {
            if (noResultRow) {
                noResultRow.remove();
            }
        }
    });

    console.log('Search initialized successfully');
});
</script>

@endsection