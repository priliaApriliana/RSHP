@extends('layouts.lte.main')

@section('page-title', 'Data Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Perawat</li>
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
        display: inline-flex;
        align-items: center;
        gap: .5rem;
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

    .action-buttons {
        display: flex;
        gap: .5rem;
        justify-content: center;
        align-items: center;
    }

    .btn-action {
        padding: .5rem .75rem;
        border-radius: 8px;
        font-size: .8125rem;
        font-weight: 600;
        border: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
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

    .gender-badge {
        padding: .25rem .75rem;
        border-radius: 6px;
        font-weight: 600;
        font-size: .8125rem;
        display: inline-block;
    }

    .gender-p {
        background: #fce4ec;
        color: #c2185b;
    }

    .gender-l {
        background: #e3f2fd;
        color: #1976d2;
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state h5 {
        color: #395886;
        font-weight: 600;
    }
</style>

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2>Data Perawat</h2>
            <a href="{{ route('admin.perawat.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle"></i> Tambah Perawat
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-card">
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
                <tbody>
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
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('admin.perawat.destroy', $p->id_perawat) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data perawat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i>
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
@endsection
