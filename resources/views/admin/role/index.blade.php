@extends('layouts.lte.main')

@section('page-title', 'Daftar Role')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Daftar Role</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">
            <!-- Header Card -->
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Role</h3>
                    <a href="{{ route('admin.role.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Role
                    </a>
                </div>
            </div>

            <!-- Body Card -->
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px">ID Role</th>
                                <th>Nama Role</th>
                                <th style="width: 150px" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($role as $r)
                                <tr>
                                    <td>{{ $r->idrole }}</td>
                                    <td>{{ $r->nama_role }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.role.edit', $r->idrole) }}" 
                                           class="btn btn-primary btn-sm me-1">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.role.destroy', $r->idrole) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus role ini?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <em class="text-muted">Belum ada data role.</em>
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
