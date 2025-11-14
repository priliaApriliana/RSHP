@extends('layouts.lte.main')

@section('page-title', 'Data Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pemilik</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Data Pemilik</h3>

                    <a href="{{ route('admin.pemilik.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Pemilik
                    </a>
                </div>
            </div>

            {{-- CARD BODY --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead>
                            <tr>
                                <th style="width: 60px">No</th>
                                <th>Nama Pemilik</th>
                                <th>No WA</th>
                                <th>Alamat</th>
                                <th style="width: 160px">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pemilik as $index => $p)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $p->user_nama ?? '-' }}</td>
                                <td>{{ $p->no_wa }}</td>
                                <td>{{ $p->alamat }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.pemilik.edit', $p->idpemilik) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.pemilik.destroy', $p->idpemilik) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm">Hapus</button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <em class="text-muted">Belum ada data pemilik.</em>
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
