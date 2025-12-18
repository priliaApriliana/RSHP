@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Perawat</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/index.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">

    {{-- HEADER --}}
    <div class="page-header">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
            <h2>Data Perawat</h2>
            <a href="{{ route('admin.perawat.create') }}" class="btn-add-new">
                <i class="bi bi-plus-circle"></i> Tambah Perawat
            </a>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="content-card">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th width="70">ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th width="130">No HP</th>
                        <th width="130">Jenis Kelamin</th>
                        <th>Pendidikan</th>
                        <th width="140">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($perawats as $p)
                    <tr>
                        <td class="text-center">{{ $p->id_perawat }}</td>
                        <td>{{ $p->nama ?? '-' }}</td>
                        <td>{{ $p->email ?? '-' }}</td>
                        <td>{{ $p->alamat }}</td>
                        <td>{{ $p->no_hp }}</td>
                        <td class="text-center">
                            <span class="gender-badge {{ $p->jenis_kelamin == 'P' ? 'gender-p' : 'gender-l' }}">
                                {{ $p->jenis_kelamin == 'P' ? 'Perempuan' : 'Laki-laki' }}
                            </span>
                        </td>
                        <td>{{ $p->pendidikan }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.perawat.edit', $p->id_perawat) }}"
                                   class="btn-action btn-edit">
                                    <i class="bi bi-pencil"></i>  Edit
                                </a>
                                <form action="{{ route('admin.perawat.destroy', $p->id_perawat) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus data perawat ini?')">
                                    @csrf @method('DELETE')
                                    <button class="btn-action btn-delete">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8">
                            <div class="empty-state">
                                <h5>Belum Ada Data Perawat</h5>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
