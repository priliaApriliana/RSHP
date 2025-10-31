@extends('layouts.app')

@section('title', 'Daftar User dan Role')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <!-- Judul Halaman -->
        <h2 class="mb-4 fw-bold text-primary">Daftar Role</h2>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('user.create') }}" 
           class="btn btn-primary fw-semibold mb-4 w-100">
           + Tambah Role
        </a>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead style="background-color: #dbeafe; color: #003680;">
                    <tr>
                        <th>ID Role</th>
                        <th>Nama Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($role as $r)
                        <tr>
                            <td>{{ $r->idrole }}</td>
                            <td>{{ $r->nama_role }}</td>
                            <td>
                                <a href="{{ route('role.edit', $r->idrole) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                   Edit
                                </a>
                                <form action="{{ route('role.destroy', $r->idrole) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger">
                                            Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-muted py-3">Belum ada data user</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
