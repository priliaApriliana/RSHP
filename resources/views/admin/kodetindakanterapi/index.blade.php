@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-header text-white" style="background-color: #0d6efd;">
            <h4 class="mb-0 fw-semibold">Data Kode Tindakan Terapi</h4>
        </div>

        <div class="card-body bg-light">
            <a href="{{ route('admin.kodetindakanterapi.create') }}" class="btn text-white mb-3 fw-medium" style="background-color: #198754;">
                + Tambah Data
            </a>

            <table class="table table-bordered text-center align-middle table-hover shadow-sm rounded">
                <thead style="background-color: #cfe2ff;">
                    <tr>
                        <th>No</th>
                        <th>ID</th>
                        <th>Kode Tindakan</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th>Kategori Klinis</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kodeTindakan as $no => $k)
                        <tr>
                            <!-- Kolom nomor urut -->
                            <td>{{ $no + 1 }}</td>

                            <!-- Kolom ID dengan blok warna -->
                            <td>
                                <span style="
                                    display: inline-block;
                                    background-color: #e7f1ff;
                                    color: #0d6efd;
                                    font-weight: 600;
                                    padding: 6px 14px;
                                    border-radius: 10px;
                                    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                                ">
                                    {{ $k->idkode_tindakan_terapi }}
                                </span>
                            </td>

                            <!-- Kolom kode tindakan -->
                            <td>{{ $k->kode }}</td>

                            <!-- Kolom deskripsi -->
                            <td>{{ $k->deskripsi_tindakan_terapi }}</td>

                            <!-- Kolom kategori -->
                            <td>{{ $k->kategori->nama_kategori ?? '-' }}</td>

                            <!-- Kolom kategori klinis -->
                            <td>{{ $k->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>

                            <!-- Kolom aksi -->
                            <td>
                                <a href="{{ route('admin.kodetindakanterapi.edit', $k->idkode_tindakan_terapi) }}" 
                                class="btn btn-warning btn-sm fw-semibold text-dark shadow-sm">Edit</a>
                                <form action="{{ route('admin.kodetindakanterapi.destroy', $k->idkode_tindakan_terapi) }}" 
                                    method="POST" class="d-inline" 
                                    onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm fw-semibold shadow-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-muted">Belum ada data tindakan terapi</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
