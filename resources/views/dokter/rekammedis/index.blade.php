@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-notes-medical"></i> Daftar Rekam Medis (Dokter)
        </h3>

        <a href="{{ route('dokter.rekammedis.create') }}" class="btn btn-success mb-3">
            <i class="fas fa-plus-circle"></i> Tambah Rekam Medis
        </a>

        <table class="table table-bordered table-hover">
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
                    <td>{{ Str::limit($r->anamnesa, 50) }}</td>
                    <td>{{ Str::limit($r->diagnosa, 50) }}</td>
                    <td>{{ $r->created_at }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada rekam medis.</td>
                </tr>
                @endforelse
            </tbody>
        </table>

        {{ $rekamMedis->links() }}
    </div>
</div>
@endsection
