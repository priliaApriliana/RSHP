@extends('layouts.app')

@section('title', 'Data Ras Hewan')

@section('content')
<div class="container mt-5">
    <div class="card p-4 shadow-sm border-0 rounded-4">

        <!-- Judul Halaman -->
        <h2 class="mb-4 fw-bold">Data Ras Hewan</h2>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('admin.rashewan.create') }}" 
           class="btn btn-primary fw-semibold mb-4">
           + Tambah Data
        </a>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover table-bordered text-center align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Ras</th>
                        <th>Jenis Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($rasHewan as $ras)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $ras->nama_ras }}</td>
                            <td>{{ $ras->jenisHewan->nama_jenis_hewan ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.rashewan.edit', $ras->idras_hewan) }}" 
                                   class="btn btn-sm btn-warning me-1">Edit</a>

                                <form action="{{ route('admin.rashewan.destroy', $ras->idras_hewan) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-sm btn-danger">
                                            Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">Belum ada data ras hewan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
