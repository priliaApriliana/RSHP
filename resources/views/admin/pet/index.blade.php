@extends('layouts.lte.main')

@section('page-title', 'Data Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Data Pet</li>
@endsection

@section('content')

<div class="row">
    <div class="col-12">

        <div class="card">

            {{-- Header Card --}}
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Tabel Data Pet</h3>
                    <a href="{{ route('admin.pet.create') }}" class="btn btn-success btn-sm">
                        <i class="bi bi-plus-circle"></i> Tambah Pet
                    </a>
                </div>
            </div>

            {{-- Body Card --}}
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 text-center align-middle">
                        <thead>
                            <tr>
                                <th style="width: 100px;">ID Pet</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Warna / Tanda</th>
                                <th>Jenis Kelamin</th>
                                <th>Ras Hewan</th>
                                <th>Pemilik</th>
                                <th style="width: 160px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pet as $p)
                            <tr>
                                <td class="fw-semibold text-primary">{{ $p->idpet }}</td>
                                <td>{{ $p->nama }}</td>
                                <td>{{ $p->tanggal_lahir }}</td>
                                <td>{{ $p->warna_tanda }}</td>
                                <td>{{ $p->jenis_kelamin }}</td>
                                <td>{{ $p->nama_ras ?? '-' }}</td>
                                <td>{{ $p->nama_pemilik ?? '-' }}</td>

                                <td class="text-center">
                                    <a href="{{ route('admin.pet.edit', $p->idpet) }}" 
                                       class="btn btn-primary btn-sm me-1">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.pet.destroy', $p->idpet) }}"
                                          method="POST" 
                                          class="d-inline"
                                          onsubmit="return confirm('Hapus data ini?')">
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
                                <td colspan="8" class="text-center py-4">
                                    <em class="text-muted">Belum ada data pet.</em>
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
