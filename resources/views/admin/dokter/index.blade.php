@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Dokter</li>
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

    {{-- HEADER --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2>Data Dokter</h2>
            <a href="{{ route('admin.dokter.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle"></i> Tambah Dokter
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
                       placeholder="Cari berdasarkan ID atau nama dokter...">
            </div>
        </div>

    {{-- CONTENT --}}
    <div class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th>Bidang</th>
                        <th width="130">No HP</th>
                        <th width="130">Jenis Kelamin</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
                    @forelse ($dokter as $d)
                    <tr>
                        <td class="text-center">{{ $d->id_dokter }}</td>
                        <td>{{ $d->bidang_dokter }}</td>
                        <td>{{ $d->no_hp }}</td>
                        <td class="text-center">
                            <span class="gender-badge {{ $d->jenis_kelamin == 'P' ? 'gender-p' : 'gender-l' }}">
                                {{ $d->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                            </span>
                        </td>
                        <td>{{ $d->nama ?? '-' }}</td>
                        <td>{{ $d->email ?? '-' }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.dokter.edit', $d->id_dokter) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <form action="{{ route('admin.dokter.destroy', $d->id_dokter) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data dokter ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <h5>Belum Ada Data Dokter</h5>
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

    if (!searchInput || !tableBody) return;

    searchInput.addEventListener('input', function () {

        const keyword = this.value.toLowerCase().trim();
        const rows = tableBody.querySelectorAll('tr');
        let visibleCount = 0;

        rows.forEach(row => {

            if (row.id === 'noResultRow') return;

            const text = row.textContent.toLowerCase();
            const match = text.includes(keyword);

            row.style.display = match ? '' : 'none';
            if (match) visibleCount++;
        });

        let noResultRow = document.getElementById('noResultRow');

        if (visibleCount === 0 && keyword !== '') {
            if (!noResultRow) {
                noResultRow = document.createElement('tr');
                noResultRow.id = 'noResultRow';
                noResultRow.innerHTML = `
                    <td colspan="7">
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="bi bi-search"></i>
                            </div>
                            <h5>Tidak Ada Hasil</h5>
                            <p>Data dengan kata "<b>${keyword}</b>" tidak ditemukan</p>
                        </div>
                    </td>
                `;
                tableBody.appendChild(noResultRow);
            }
        } else {
            if (noResultRow) noResultRow.remove();
        }
    });
});
</script>

@endsection
