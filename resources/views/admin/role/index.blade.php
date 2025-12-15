@extends('layouts.lte.main')

@section('page-title', 'Daftar Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Role</li>
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
    
    .card-header-custom {
        padding: 1.5rem;
        background: linear-gradient(to bottom, #F0F3FA 0%, #ffffff 100%);
        border-bottom: 2px solid #D5DEEF;
    }
    
    .card-title-custom {
        color: #395886;
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0;
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
    }
    
    .data-table thead th {
        padding: 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        color: #395886;
        text-transform: uppercase;
        letter-spacing: 0.8px;
        border: 2px solid #D5DEEF;
        border-top: none;
        text-align: center;
    }
    
    .data-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border: 2px solid #D5DEEF;
        font-size: 0.875rem;
        color: #395886;
        text-align: center;
    }
    
    .data-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .data-table tbody tr:hover {
        background: linear-gradient(to right, #F8FAFC 0%, #F0F3FA 100%);
    }
    
    .id-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.375rem 0.875rem;
        background: linear-gradient(135deg, #B1C9EF 0%, #8AAEE0 100%);
        color: #395886;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.8125rem;
        min-width: 60px;
    }
    
    .role-name {
        font-weight: 600;
        color: #395886;
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
        {{-- Card Header --}}
        <div class="card-header-custom">
            <h3 class="card-title-custom">Tabel Role</h3>
        </div>

        {{-- Table Section --}}
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th style="width: 150px">ID Role</th>
                        <th>Nama Role</th>
                        <th style="width: 200px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
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
                                          style="margin: 0;"
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
                        <tr>
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

@endsection