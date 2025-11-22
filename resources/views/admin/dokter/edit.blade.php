@extends('layouts.lte.main')

@section('page-title', 'Edit Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title"><i class="fas fa-user-md"></i> Edit Data Dokter</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('admin.dokter.update', $dokter->id_dokter) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label>Alamat</label>
                <input type="text" name="alamat" value="{{ $dokter->alamat }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>No HP</label>
                <input type="text" name="no_hp" value="{{ $dokter->no_hp }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Bidang Dokter</label>
                <input type="text" name="bidang_dokter" value="{{ $dokter->bidang_dokter }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="L" {{ $dokter->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ $dokter->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>User</label>
                <select name="id_user" class="form-control" required>

                    @foreach($user as $u)
                    <option value="{{ $u->iduser }}" 
                        {{ $dokter->id_user == $u->iduser ? 'selected' : '' }}>
                        {{ $u->nama }} ({{ $u->email }})
                    </option>
                    @endforeach

                </select>
            </div>

            <button class="btn btn-primary"><i class="fas fa-save"></i> Update</button>
            <a href="{{ route('admin.dokter.index') }}" class="btn btn-secondary">Kembali</a>

        </form>

    </div>
</div>

@endsection
