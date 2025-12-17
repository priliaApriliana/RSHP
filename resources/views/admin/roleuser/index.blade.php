@extends('layouts.lte.main')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Manajemen Role</li>
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
    
    .content-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
        overflow: hidden;
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
    }
    
    .data-table tbody td {
        padding: 1rem;
        vertical-align: middle;
        border: 2px solid #D5DEEF;
        font-size: 0.875rem;
        color: #395886;
    }
    
    .data-table tbody tr {
        transition: all 0.2s ease;
    }
    
    .data-table tbody tr:hover {
        background: linear-gradient(to right, #F8FAFC 0%, #F0F3FA 100%);
    }
    
    .user-id {
        font-weight: 700;
        color: #628ECB;
    }
    
    .user-name {
        font-weight: 600;
        color: #395886;
    }
    
    .role-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.875rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .role-badge.active {
        background: linear-gradient(135deg, #66BB6A 0%, #43A047 100%);
        color: #ffffff;
    }
    
    .role-badge.inactive {
        background: #E0E0E0;
        color: #757575;
    }
    
    .role-badge.empty {
        background: #F5F5F5;
        color: #9E9E9E;
    }
    
    .role-actions {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }
    
    .btn-add-role {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        text-decoration: none;
    }
    
    .btn-add-role:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(98, 142, 203, 0.3);
        color: #ffffff;
    }
    
    .role-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        background: #F8FAFC;
        border-radius: 10px;
        border: 1px solid #D5DEEF;
    }
    
    .role-name {
        font-weight: 600;
        color: #395886;
        min-width: 120px;
        font-size: 0.875rem;
    }
    
    .btn-group-custom {
        display: flex;
        gap: 0.5rem;
        margin-left: auto;
    }
    
    .btn-action-sm {
        padding: 0.375rem 0.75rem;
        border-radius: 6px;
        font-size: 0.8125rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .btn-edit-sm {
        background: linear-gradient(135deg, #4FC3F7 0%, #0288D1 100%);
        color: #ffffff;
    }
    
    .btn-edit-sm:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(2, 136, 209, 0.3);
        color: #ffffff;
    }
    
    .btn-delete-sm {
        background: linear-gradient(135deg, #ff7675 0%, #d63031 100%);
        color: #ffffff;
    }
    
    .btn-delete-sm:hover {
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
        <div>
            <h2>Manajemen Role User</h2>
            <p>Kelola dan atur role untuk setiap user dalam sistem</p>
        </div>
    </div>

    {{-- Content Card --}}
    <div class="content-card">
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
                <tbody>
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
                    <tr>
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

@endsection