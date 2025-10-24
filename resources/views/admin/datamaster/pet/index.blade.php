@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow border-0 rounded-4 overflow-hidden">

        <!-- HEADER -->
        <div class="card-header d-flex justify-content-between align-items-center text-white px-4 py-3"
             style="background-color: #004aad;">
            <h4 class="mb-0 fw-semibold">Data Pet</h4>
            <a href="{{ route('pet.create') }}" 
               class="btn text-white fw-semibold shadow-sm"
               style="background-color: #004aad; border: 2px solid white; border-radius: 8px;">
               + Tambah Pet
            </a>
        </div>

        <!-- BODY -->
        <div class="card-body bg-light p-4">
            <table class="table table-hover text-center align-middle shadow-sm rounded-3 overflow-hidden">
                <thead class="text-white" style="background-color: #004aad;">
                    <tr>
                        <th>ID Pet</th>
                        <th>Nama</th>
                        <th>Tanggal Lahir</th>
                        <th>Warna/Tanda</th>
                        <th>Jenis Kelamin</th>
                        <th>Ras</th>
                        <th>Pemilik</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($pet as $p)
                    <tr class="{{ $loop->even ? 'bg-even' : 'bg-odd' }}">
                            <td class="fw-semibold text-primary">{{ $p->idpet }}</td>
                            <td>{{ $p->nama_pet }}</td>
                            <td>{{ $p->tanggal_lahir }}</td>
                            <td>{{ $p->warna_tanda }}</td>
                            <td>{{ $p->jenis_kelamin }}</td>
                            <td>{{ $p->rasHewan->nama_ras ?? '-' }}</td>
                            <td>{{ $p->pemilik->nama ?? '-' }}</td>
                            <td>
                                <a href="{{ route('pet.edit', $p->idpet) }}" 
                                   class="btn fw-semibold btn-sm text-white shadow-sm me-1"
                                   style="background-color: #ffb703;">
                                   Edit
                                </a>
                                <form action="{{ route('pet.destroy', $p->idpet) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="btn fw-semibold btn-sm text-white shadow-sm"
                                            style="background-color: #d90429;">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-muted py-3">
                                Belum ada data pet.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
/* Estetika tabel dan tombol */
.table th, .table td {
    vertical-align: middle !important;
}
.table-hover tbody tr:hover {
    background-color: #e0ebff !important;
    transition: 0.2s;
}
.card {
    border-radius: 16px !important;
}
</style>
@endsection
