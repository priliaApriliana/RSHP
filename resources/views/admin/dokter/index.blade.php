@extends('layouts.lte.main')

@section('page-title', 'Data Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Dokter</li>
@endsection

@section('content')

<style>
.table-modern th {
    background: #395886;
    color: #fff;
}
.btn-soft {
    background: #628ECB;
    color: #fff;
    border-radius: 8px;
}
</style>

<div class="card admin-card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3><i class="bi bi-person-badge"></i> Data Dokter</h3>
        <a href="{{ route('admin.dokter.create') }}" class="btn btn-soft">
            <i class="bi bi-plus-circle"></i> Tambah
        </a>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-hover table-modern">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Bidang</th>
                    <th>No HP</th>
                    <th>Gender</th>
                    <th>User</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokter as $d)
                <tr>
                    <td>{{ $d->id_dokter }}</td>
                    <td>{{ $d->bidang_dokter }}</td>
                    <td>{{ $d->no_hp }}</td>
                    <td>{{ $d->jenis_kelamin }}</td>
                    <td>{{ $d->nama ?? '-' }}</td>
                    <td class="text-center">
                        <a href="{{ route('admin.dokter.edit',$d->id_dokter) }}" class="btn btn-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form method="POST" action="{{ route('admin.dokter.destroy',$d->id_dokter) }}" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm">
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
