@extends('layouts.app')

@section('content')
<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-hospital"></i> RSHP</h3>
    </div>

    <ul class="sidebar-menu">
        <li><a href="{{ route('resepsionis.dashboard') }}" class="menu-link">
            <i class="fas fa-home"></i> Dashboard</a></li>

        <li><a href="{{ url('/admin/pet') }}" class="menu-link">
            <i class="fas fa-paw"></i> Pet</a></li>

        <li><a href="{{ url('/admin/pemilik') }}" class="menu-link">
            <i class="fas fa-users"></i> Pemilik</a></li>

        <li><a href="{{ url('/resepsionis/temudokter') }}" class="menu-link active">
            <i class="fas fa-user-md"></i> Temu Dokter</a></li>

        <li><a href="{{ route('logout') }}" class="menu-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i> Logout</a>
        </li>
    </ul>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
</div>

<div class="main-content" id="mainContent">
    <nav class="navbar-custom">
        <div class="d-flex justify-content-between align-items-center">
            <button class="toggle-btn" onclick="toggleSidebar()">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-profile">
                <span class="fw-semibold">Resepsionis</span>
                <div class="user-avatar">R</div>
            </div>
        </div>
    </nav>

    <div class="container-fluid px-4 mt-4">
        <h2 class="fw-bold mb-4" style="color: var(--primary-blue);">Manajemen Temu Dokter</h2>

        <!-- Tombol Tambah -->
        <div class="mb-3 text-end">
            <a href="{{ url('/resepsionis/temudokter/create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Reservasi
            </a>
        </div>

        <!-- Tabel daftar temu dokter -->
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body">
                <table class="table table-striped align-middle">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>No</th>
                            <th>No. Urut</th>
                            <th>Nama Pet</th>
                            <th>Pemilik</th>
                            <th>Dokter Pemeriksa</th>
                            <th>Tanggal Daftar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($temuDokter as $index => $data)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $data->no_urut }}</td>
                            <td>{{ $data->pet->nama ?? '-' }}</td>
                            <td>{{ $data->pet->pemilik->user->nama ?? '-' }}</td>
                            <td>{{ $data->roleUser->user->nama ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->waktu_daftar)->format('d M Y') }}</td>
                            <td>
                                @if($data->status == 'A')
                                    <span class="badge bg-success">Aktif</span>
                                @elseif($data->status == 'S')
                                    <span class="badge bg-info text-dark">Selesai</span>
                                @else
                                    <span class="badge bg-secondary">Menunggu</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ url('/resepsionis/temudokter/edit/'.$data->idreservasi_dokter) }}" class="btn btn-sm btn-warning">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ url('/resepsionis/temudokter/delete/'.$data->idreservasi_dokter) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-muted">Belum ada data reservasi dokter.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
