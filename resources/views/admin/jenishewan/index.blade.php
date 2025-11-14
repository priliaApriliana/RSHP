@extends('layouts.lte.main')

@section('page-title', 'Data Jenis Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Jenis Hewan</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Jenis Hewan</h3>
                    <a href="{{ route('admin.jenishewan.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Jenis Hewan
                    </a>
                </div>
            </div>

            {{-- BODY --}}
            <div class="card-body p-0">
                <div class="table-responsive">

                    <table class="table table-hover table-striped mb-0">
                        <thead>
                            <tr>
                                <th style="width: 60px;">No</th>
                                <th style="width: 140px;">ID Jenis</th>
                                <th>Nama Jenis Hewan</th>
                                <th style="width: 150px;" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($jenisHewan as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td class="fw-semibold text-primary">{{ $item->idjenis_hewan }}</td>
                                    <td>{{ $item->nama_jenis_hewan }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('admin.jenishewan.edit', $item->idjenis_hewan) }}" 
                                           class="btn btn-warning btn-sm me-1">
                                            Edit
                                        </a>

                                        <form action="{{ route('admin.jenishewan.destroy', $item->idjenis_hewan) }}" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                    <td colspan="4" class="text-center py-4">
                                        <em class="text-muted">Belum ada data jenis hewan</em>
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
