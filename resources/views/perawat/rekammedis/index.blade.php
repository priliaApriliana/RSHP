<!-- untuk Menampilkan daftar semua data (list rekam medis) -->
@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-notes-medical"></i> Daftar Rekam Medis
        </h3>

        <a href="{{ route('perawat.rekammedis.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Tambah Rekam Medis
        </a>

        <table class="card">
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Hewan</th>
                            <th>Pemilik</th>
                            <th>Anamnesa</th>
                            <th>Diagnosa</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($rekamMedis as $r)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $r->temuDokter->pet->nama ?? '-' }}</td>
                            <td>{{ $r->temuDokter->pet->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ Str::limit($r->anamnesa, 40) }}</td>
                            <td>{{ Str::limit($r->diagnosa, 40) }}</td>
                            <td>{{ $r->created_at }}</td>
                            <td>
                                <a href="{{ route('perawat.rekammedis.show', $r->idrekam_medis) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('perawat.rekammedis.edit', $r->idrekam_medis) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Belum ada data rekam medis.</td>
                        </tr>
                        @endforelse
                    </tbody>
        </table>
        {{ $rekamMedis->links() }}
            </div>
    </div>
</div>
@endsection


