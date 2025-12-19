@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Perawat</li>
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
            <h2>Data Perawat</h2>
            <a href="{{ route('admin.perawat.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle"></i> Tambah Perawat
            </a>
        </div>
    </div>

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
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th width="130">No HP</th>
                        <th width="130">Jenis Kelamin</th>
                        <th>Pendidikan</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody  id="tableBody">
                    @forelse ($perawats as $p)
                    <tr>
                        <td class="text-center">{{ $p->id_perawat }}</td>
                        <td>{{ $p->nama ?? '-' }}</td>
                        <td>{{ $p->email ?? '-' }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td class="text-center">
                            <span class="gender-badge {{ $p->jenis_kelamin == 'P' ? 'gender-p' : 'gender-l' }}">
                                {{ $p->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                            </span>
                        </td>
                        <td>{{ $p->pendidikan }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.perawat.edit', $p->id_perawat) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>  Edit
                                </a>
                                <form action="{{ route('admin.perawat.destroy', $p->id_perawat) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data perawat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <h5>Belum Ada Data Perawat</h5>
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
                    <td colspan="6">
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
