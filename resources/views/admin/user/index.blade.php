@extends('layouts.app')

@section('title', 'Daftar User dan Role')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm border-0 rounded-4">
        <h2 class="mb-4 fw-bold">Daftar User dan Role</h2>

        <a href="{{ route('admin.user.create') }}" 
           class="btn btn-primary w-100 mb-3 fw-semibold">
           + Tambah User
        </a>

        <table class="table table-hover table-bordered text-center align-middle">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($user as $u)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $u->iduser }}</td>
                        <td>{{ $u->nama }}</td>
                        <td>{{ $u->email }}</td>
                        <td>
                            @if($u->role->isNotEmpty())
                                {{ $u->role->pluck('nama_role')->join(', ') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.user.edit', $u->iduser) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.user.destroy', $u->iduser) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
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
@endsection
