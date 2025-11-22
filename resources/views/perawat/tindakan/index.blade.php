@extends('layouts.lte.main')

@section('page-title', 'Data Kode Tindakan Terapi')

@section('content')

{{-- BUTTON TAMBAH --}}
<div class="d-flex justify-content-end mb-3">
    <a href="{{ route('perawat.tindakan.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Tambah Tindakan Terapi
    </a>
</div>

{{-- ALERT --}}
@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- TABEL --}}
<div class="card">
    <div class="card-body table-responsive">

        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Deskripsi</th>
                    <th>Kategori</th>
                    <th>Kategori Klinis</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($data as $i => $row)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $row->kode }}</td>
                    <td>{{ $row->deskripsi_tindakan_terapi }}</td>
                    <td>{{ $row->kategori->nama_kategori ?? '-' }}</td>
                    <td>{{ $row->kategoriKlinis->nama_kategori_klinis ?? '-' }}</td>

                    <td>
                        <a href="{{ route('perawat.tindakan.edit', $row->idkode_tindakan_terapi) }}"
                           class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil"></i> Edit
                        </a>

                        <form action="{{ route('perawat.tindakan.destroy', $row->idkode_tindakan_terapi) }}"
                              method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="bi bi-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
