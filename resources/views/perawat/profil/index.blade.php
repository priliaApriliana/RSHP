@extends('layouts.lte.main')

@section('page-title', 'Profil Perawat')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('perawat.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item active">Profil</li>
@endsection

@section('content')

<style>
:root {
    --blue-light: #8AAEE0;
    --blue-soft: #B1C9EF;
    --blue-main: #628ECB;
    --blue-bg: #D5DEEF;
    --blue-dark: #395886;
    --blue-white: #F0F3FA;
}

/* ===== ALERT ===== */
.alert-success {
    background: linear-gradient(135deg, var(--blue-white), var(--blue-bg));
    border: 2px solid var(--blue-soft);
    color: var(--blue-dark);
    border-radius: 12px;
}

/* ===== CARD ===== */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 12px rgba(98,142,203,.15);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, var(--blue-main), var(--blue-dark));
    color: white;
    padding: 20px 24px;
}

.card-title {
    font-weight: 700;
    font-size: 18px;
}

/* ===== PROFILE ===== */
.profile-user-img {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    color: white;
    box-shadow: 0 4px 12px rgba(98,142,203,.3);
}

.profile-username {
    font-weight: 700;
    color: var(--blue-dark);
}

.list-group-item {
    border: none;
    border-bottom: 1px solid var(--blue-bg);
    color: var(--blue-dark);
}

/* ===== FORM ===== */
.form-control {
    border: 2px solid var(--blue-bg);
    border-radius: 10px;
    padding: 10px 14px;
    color: var(--blue-dark);
}

.form-control:focus {
    border-color: var(--blue-main);
    box-shadow: 0 0 0 4px rgba(98,142,203,.15);
}

label {
    font-weight: 600;
    color: var(--blue-dark);
}

/* ===== BUTTON ===== */
.btn-primary,
.btn-secondary {
    background: linear-gradient(135deg, var(--blue-light), var(--blue-main));
    border: none;
    color: white;
    font-weight: 600;
    border-radius: 10px;
    padding: 10px 22px;
}

.card-footer {
    background: var(--blue-white);
    border-top: 2px solid var(--blue-bg);
    padding: 20px 24px;
}

    .btn-blue {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    
    .btn-blue:hover {
        background: linear-gradient(135deg, #395686 0%, #2d4570 100%);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.3);
        color: white;
    }
</style>

{{-- ALERT --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <i class="bi bi-check-circle"></i> {{ session('success') }}
</div>
@endif

<div class="row">
    <!-- PROFIL -->
    <div class="col-md-4">
        <div class="card mb-4">
            <div class="card-body box-profile text-center">
                <div class="profile-user-img img-circle mx-auto d-flex align-items-center justify-content-center"
                     style="width:100px;height:100px;font-size:42px;">
                    <i class="bi bi-people"></i>
                </div>

                <h3 class="profile-username mt-3">{{ $user->nama }}</h3>
                <p class="text-muted">Perawat</p>

                <ul class="list-group list-group-unbordered text-start">
                    <li class="list-group-item">
                        <b>Email</b>
                        <span class="float-right">{{ $user->email }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>No. HP</b>
                        <span class="float-right">{{ $perawat->no_hp ?? '-' }}</span>
                    </li>
                    <li class="list-group-item">
                        <b>Jenis Kelamin</b>
                        <span class="float-right">
                            @if($perawat?->jenis_kelamin === 'L')
                                Laki-laki
                            @elseif($perawat?->jenis_kelamin === 'P')
                                Perempuan
                            @else
                                -
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- EDIT PROFIL -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"><i class="bi bi-pencil-square"></i> Edit Profil</h3>
            </div>

            <form action="{{ route('perawat.profil.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">
                    <div class="form-group">
                        <label>Nama Lengkap *</label>
                        <input type="text" name="nama" class="form-control" value="{{ old('nama',$user->nama) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Email *</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email',$user->email) }}" required>
                    </div>

                    <div class="form-group">
                        <label>Password Baru</label>
                        <input type="password" name="password" class="form-control"
                               placeholder="Kosongkan jika tidak diubah">
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>

                    <div class="form-group">
                        <label>Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control">
                    </div>

                    <hr>

                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" rows="3" class="form-control">{{ old('alamat',$perawat->alamat ?? '') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>No. HP</label>
                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp',$perawat->no_hp ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control">
                            <option value="">-- Pilih --</option>
                            <option value="L" {{ old('jenis_kelamin',$perawat->jenis_kelamin ?? '')=='L'?'selected':'' }}>Laki-laki</option>
                            <option value="P" {{ old('jenis_kelamin',$perawat->jenis_kelamin ?? '')=='P'?'selected':'' }}>Perempuan</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Pendidikan Terakhir</label>
                        <input type="text" name="pendidikan" class="form-control"
                               value="{{ old('pendidikan',$perawat->pendidikan ?? '') }}">
                    </div>
                </div>

                <div class="card-footer text-end">
                    {{-- SIMPAN --}}
                    <button type="submit" class="btn btn-blue">
                        <i class="bi bi-check-circle me-2"></i> Simpan
                    </button>
                    <a href="{{ route('perawat.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left-circle me-2"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
