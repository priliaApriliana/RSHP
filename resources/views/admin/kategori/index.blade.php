@extends('layouts.lte.main')

@section('page-title', 'Daftar Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Kategori</h3>
                    <a href="{{ route('admin.kategori.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </a>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 70px;">No</th>
                                <th>Nama Kategori</th>
                                <th style="width: 150px" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kategori as $no => $k)
                                <tr>
                                    <td>{{ $no + 1 }}</td>
                                    <td>{{ $k->nama_kategori }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.kategori.edit', $k->idkategori) }}"
                                           class="btn btn-warning btn-sm me-1">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Hapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4">
                                        <em class="text-muted">Belum ada data kategori</em>
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
