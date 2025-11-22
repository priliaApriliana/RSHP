@extends('layouts.lte.main')

@section('page-title', 'Tambah Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-md"></i> Form Tambah Dokter</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.dokter.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Bidang Dokter</label>
                <input type="text" name="bidang_dokter" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>User</label>
                <select name="id_user" class="form-control" required>
                    <option value="">-- Pilih User --</option>

                    @foreach($user as $u)
                    <option value="{{ $u->iduser }}">{{ $u->nama }} ({{ $u->email }})</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
