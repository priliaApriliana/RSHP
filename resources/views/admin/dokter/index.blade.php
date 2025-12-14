@extends('layouts.lte.main')

@section('page-title', 'Data Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Dokter</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h3 class="card-title"><i class="fas fa-user-md"></i> Data Dokter</h3>

        <a href="{{ route('admin.dokter.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus"></i> Tambah Dokter
        </a>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Bidang Dokter</th>
                    <th>Jenis Kelamin</th>
                    <th>User</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($dokter as $d)
                <tr>
                    <td>{{ $d->id_dokter }}</td>
                    <td>{{ $d->alamat }}</td>
                    <td>{{ $d->no_hp }}</td>
                    <td>{{ $d->bidang_dokter }}</td>
                    <td>{{ $d->jenis_kelamin }}</td>
                    <td>{{ $d->nama ?? '-' }}</td>

                    <td class="text-center">
                        <a href="{{ route('admin.dokter.edit', $d->id_dokter) }}" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <form action="{{ route('admin.dokter.destroy', $d->id_dokter) }}"
                              method="POST"
                              style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
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
