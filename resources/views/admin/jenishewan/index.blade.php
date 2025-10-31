@extends('layouts.app')

@section('title', 'Data Jenis Hewan')

@section('content')
<div class="container">
    <div class="card">
        <h2>Data Jenis Hewan</h2>

        <!-- Tombol Tambah Data -->
        <a href="{{ route('jenishewan.create') }}" class="btn btn-primary mb-4">
            + Tambah Jenis Hewan
        </a>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover text-center align-middle">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>ID Jenis Hewan</th>
                        <th>Nama Jenis Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jenisHewan as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->idjenis_hewan }}</td>
                            <td class="text-start ps-3">{{ $item->nama_jenis_hewan }}</td>
                            <td>
                                <a href="{{ route('jenishewan.edit', $item->idjenis_hewan) }}" 
                                   class="btn btn-sm btn-warning me-1">
                                   Edit
                                </a>
                                <form action="{{ route('jenishewan.destroy', $item->idjenis_hewan) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-muted py-3">Belum ada data jenis hewan</td>
                        </tr>
                    @endforelse
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
