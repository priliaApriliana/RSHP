@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <!-- HEADER -->
        <div class="card-header text-white" style="background-color: #0d6efd;">
            <h4 class="mb-0 fw-semibold">Data Kategori</h4>
        </div>

        <!-- BODY -->
        <div class="card-body bg-light">
            <!-- Tombol Tambah -->
            <a href="{{ route('admin.kategori.create') }}" 
               class="btn text-white mb-3 fw-medium" 
               style="background-color: #198754;">
                + Tambah Data
            </a>

            <!-- TABEL -->
            <table class="table table-bordered text-center align-middle table-hover shadow-sm rounded">
                <thead style="background-color: #cfe2ff;">
                    <tr>
                        <th class="fw-semibold">No</th>
                        <th class="fw-semibold">Nama Kategori</th>
                        <th class="fw-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $no => $k)
                        <tr >
                            <td>{{ $no + 1 }}</td>
                            <td>{{ $k->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('admin.kategori.edit', $k->idkategori) }}" 
                                   class="btn btn-warning btn-sm fw-semibold text-dark shadow-sm">
                                    Edit
                                </a>
                                <form action="{{ route('admin.kategori.destroy', $k->idkategori) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-muted">Belum ada data kategori</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection