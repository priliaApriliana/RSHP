@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Data Pemilik</h4>
        </div>
        <div class="card-body">
            <a href="{{ route('pemilik.create') }}" class="btn btn-success mb-3">+ Tambah Pemilik</a>

            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-primary">
                    <tr>
                        <th>No</th>
                        <th>Nama Pemilik</th>
                        <th>No WA</th>
                        <th>Alamat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pemilik as $no => $p)
                        <tr>
                            <td>{{ $no+1 }}</td>
                            <td>{{ $p->user->nama ?? '-' }}</td>
                            <td>{{ $p->no_wa }}</td>
                            <td>{{ $p->alamat }}</td>
                            <td>
                                <a href="{{ route('pemilik.edit', $p->idpemilik) }}" class="btn btn-warning btn-sm text-white">Edit</a>
                                <form action="{{ route('pemilik.destroy', $p->idpemilik) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
