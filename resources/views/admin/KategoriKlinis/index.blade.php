@extends('layouts.lte.main')

@section('page-title', 'Kategori Klinis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Kategori Klinis</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Kategori Klinis</h3>

                    <a href="{{ route('admin.kategoriklinis.create') }}" 
                       class="btn btn-success btn-sm">
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
                                <th style="width: 70px">No</th>
                                <th>Nama Kategori Klinis</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($kategoriKlinis as $no => $k)
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>{{ $k->nama_kategori_klinis }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.kategoriklinis.edit', $k->idkategori_klinis) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.kategoriklinis.destroy', $k->idkategori_klinis) }}" 
                                          method="POST" class="d-inline"
                                          onsubmit="return confirm('Hapus data ini?')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" 
                                                class="btn btn-danger btn-sm">
                                            Hapus
                                        </button>
                                    </form>
                                </td>
                            </tr>

                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-4">
                                    <em class="text-muted">Belum ada data kategori klinis.</em>
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
