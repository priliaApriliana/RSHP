{{-- profil/edit.blade.php --}}
@extends('layouts.lte.main')

@section('page-title', 'Edit Profil')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('perawat.profil') }}">Profil</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="bi bi-pencil-square"></i> Edit Profil Perawat
                </h3>
            </div>

            <form action="{{ route('perawat.profil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               name="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               value="{{ old('nama', $user->nama) }}" 
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               value="{{ old('email', $user->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-select">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin ?? '') == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin ?? '') == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <!-- No HP -->
                    <div class="mb-3">
                        <label class="form-label">No. Handphone</label>
                        <input type="text" 
                               name="no_hp" 
                               class="form-control @error('no_hp') is-invalid @enderror" 
                               value="{{ old('no_hp', $perawat->no_hp ?? '') }}" 
                               placeholder="08xxxxxxxxxx">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-3">
                        <label class="form-label">Alamat</label>
                        <textarea name="alamat" 
                                  class="form-control @error('alamat') is-invalid @enderror" 
                                  rows="3">{{ old('alamat', $perawat->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pendidikan -->
                    <div class="mb-3">
                        <label class="form-label">Pendidikan</label>
                        <input type="text" 
                               name="pendidikan" 
                               class="form-control @error('pendidikan') is-invalid @enderror" 
                               value="{{ old('pendidikan', $perawat->pendidikan ?? '') }}" 
                               placeholder="Contoh: D3 Keperawatan">
                        @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('perawat.profil') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection