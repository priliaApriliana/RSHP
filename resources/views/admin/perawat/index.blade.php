@extends('layouts.lte.main')

@section('page-title', 'Data Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Perawat</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title"><i class="bi bi-user-nurse"></i> Data Perawat</h3>

        <a href="{{ route('admin.perawat.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus"></i> Tambah Perawat
        </a>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Jenis Kelamin</th>
                    <th>Pendidikan</th>
                    <th>User</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($perawats as $p)
                <tr>
                    <td>{{ $p->id_perawat }}</td>
                    <td>{{ $p->alamat }}</td>
                    <td>{{ $p->no_hp }}</td>
                    <td>{{ $p->jenis_kelamin }}</td>
                    <td>{{ $p->pendidikan }}</td>
                    {{-- User dari join --}}
                    <td>{{ $p->nama ?? '-' }}</td>

                    <td>
                        <a href="{{ route('admin.perawat.edit', $p->id_perawat) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil-square"></i>
                        </a>

                        <form action="{{ route('admin.perawat.destroy', $p->id_perawat) }}" 
                              class="d-inline" method="POST">
                            @csrf @method('DELETE')

                            <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus perawat ini?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
