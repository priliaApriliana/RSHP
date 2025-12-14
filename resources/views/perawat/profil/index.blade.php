@extends('layouts.lte.main')

@section('page-title', 'Profil Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')
<!-- Alert Messages -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="fas fa-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="row">
    <!-- Profil Card -->
    <div class="col-md-4">
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <div class="text-center">
                    <div class="profile-user-img img-fluid img-circle bg-primary text-white d-flex align-items-center justify-content-center mx-auto" 
                         style="width: 100px; height: 100px; font-size: 48px;">
                        <i class="fas fa-user-nurse"></i>
                    </div>
                </div>

                <h3 class="profile-username text-center">{{ $user->nama }}</h3>
                <p class="text-muted text-center">Perawat</p>

                <ul class="list-group list-group-unbordered mb-3">
                    <li class="list-group-item">
                        <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>No. HP</b> <a class="float-right">{{ $perawat->no_hp ?? '-' }}</a>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Kelamin</b> 
                        <a class="float-right">
                            @if($perawat && $perawat->jenis_kelamin === 'L')
                                Laki-laki
                            @elseif($perawat && $perawat->jenis_kelamin === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Edit Profil -->
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-edit"></i> Edit Profil</h3>
            </div>

            <form action="{{ route('perawat.profil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <!-- Nama -->
                    <div class="form-group">
                        <label for="nama">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="nama" id="nama" 
                               value="{{ old('nama', $user->nama) }}"
                               class="form-control @error('nama') is-invalid @enderror" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-group">
                        <label for="email">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" 
                               value="{{ old('email', $user->email) }}"
                               class="form-control @error('email') is-invalid @enderror" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label for="password">Password Baru</label>
                        <input type="password" name="password" id="password" 
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Kosongkan jika tidak ingin mengubah password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Minimal 6 karakter. Kosongkan jika tidak ingin mengubah password.
                        </small>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                               class="form-control"
                               placeholder="Ulangi password baru">
                    </div>

                    <hr>

                    <!-- Alamat -->
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="3" 
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Alamat lengkap...">{{ old('alamat', $perawat->alamat ?? '') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="text" name="no_hp" id="no_hp" 
                               value="{{ old('no_hp', $perawat->no_hp ?? '') }}"
                               class="form-control @error('no_hp') is-invalid @enderror"
                               placeholder="08xxxxxxxxxx">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Jenis Kelamin -->
                    <div class="form-group">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control @error('jenis_kelamin') is-invalid @enderror">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin', $perawat->jenis_kelamin ?? '') === 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P" {{ old('jenis_kelamin', $perawat->jenis_kelamin ?? '') === 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pendidikan -->
                    <div class="form-group">
                        <label for="pendidikan">Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" id="pendidikan" 
                               value="{{ old('pendidikan', $perawat->pendidikan ?? '') }}"
                               class="form-control @error('pendidikan') is-invalid @enderror"
                               placeholder="Contoh: S1 Keperawatan">
                        @error('pendidikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('perawat.dashboard') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection