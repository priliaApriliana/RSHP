@extends('layouts.lte.main')

@section('page-title', 'Data Ras Hewan')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Ras Hewan</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- Header Card --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Data Ras Hewan</h3>

                    <a href="{{ route('admin.rashewan.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Data
                    </a>
                </div>
            </div>

            {{-- Body Card --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead>
                            <tr>
                                <th style="width: 60px">No</th>
                                <th>Nama Ras</th>
                                <th>Jenis Hewan</th>
                                <th style="width: 150px" class="text-center">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($rasHewan as $ras)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $ras->nama_ras }}</td>
                                <td>{{ $ras->nama_jenis_hewan ?? '-' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.rashewan.edit', $ras->idras_hewan) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.rashewan.destroy', $ras->idras_hewan) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <em class="text-muted">Belum ada data ras hewan</em>
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
