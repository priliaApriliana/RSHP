@extends('layouts.lte.main')

@section('page-title', 'Daftar Role User')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Role User</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Role User</h3>
                    <a href="{{ route('admin.roleuser.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Relasi
                    </a>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px">No</th>
                                <th>Nama User</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th style="width: 100px">Status</th>
                                <th style="width: 150px" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roleUsers as $index => $ru)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ru->nama_user }}</td>
                                <td>{{ $ru->email_user }}</td>
                                <td>{{ $ru->nama_role }}</td>
                                <td>
                                    <span class="badge {{ $ru->status == 1 ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $ru->status == 1 ? 'Aktif' : 'Nonaktif' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admin.roleuser.edit', $ru->idrole_user) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.roleuser.destroy', $ru->idrole_user) }}"
                                          method="POST" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <em class="text-muted">Tidak ada data</em>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection