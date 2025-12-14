@extends('layouts.lte.main')

@section('page-title', 'Data Kode Tindakan Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kode Tindakan Terapi</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Kode Tindakan Terapi</h3>

                    <a href="{{ route('admin.kodetindakanterapi.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Data
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
                                <th>ID</th>
                                <th>Kode</th>
                                <th>Deskripsi</th>
                                <th>Kategori</th>
                                <th>Kategori Klinis</th>
                                <th style="width: 160px">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kodeTindakan as $index => $k)
                            <tr>
                                <td>{{ $index + 1 }}</td>

                                {{-- ID dengan badge --}}
                                <td>
                                    <span class="badge bg-primary text-white px-3 py-2">
                                        {{ $k->idkode_tindakan_terapi }}
                                    </span>
                                </td>

                                <td>{{ $k->kode }}</td>
                                <td>{{ $k->deskripsi_tindakan_terapi }}</td>
                                <td>{{ $k->nama_kategori ?? '-' }}</td>
                                <td>{{ $k->nama_kategori_klinis ?? '-' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.kodetindakanterapi.edit', $k->idkode_tindakan_terapi) }}"
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kodetindakanterapi.destroy', $k->idkode_tindakan_terapi) }}"
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
                                <td colspan="7" class="text-center py-4">
                                    <em class="text-muted">Belum ada data tindakan terapi.</em>
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
