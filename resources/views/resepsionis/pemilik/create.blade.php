@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<style>
    :root {
        --primary-blue: #628ECB;
        --light-blue: #8AAEE0;
        --lighter-blue: #B1C9EF;
        --lightest-blue: #D5DEEF;
        --very-light-blue: #F0F3FA;
        --dark-blue: #395686;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue) !important;
        box-shadow: 0 0 0 0.2rem rgba(98, 142, 203, 0.25) !important;
    }
    
    .form-label {
        color: #395686;
        font-weight: 500;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                    <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i>Registrasi Pemilik Hewan</h5>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0" style="background-color: rgba(98, 142, 203, 0.1); color: #628ECB;">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-exclamation-circle me-2"></i><strong>Gagal!</strong> {{ session('error') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-exclamation-circle me-2"></i><strong>Validasi Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-person-fill me-2" style="color: #628ECB;"></i>Nama Pemilik</label>
                            <input type="text" name="nama" class="form-control " placeholder="Masukkan nama pemilik" value="{{ old('nama') }}" required>
                            @error('nama')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-envelope-fill me-2" style="color: #628ECB;"></i>Email</label>
                            <input type="email" name="email" class="form-control " placeholder="Masukkan email" value="{{ old('email') }}" required>
                            @error('email')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-key-fill me-2" style="color: #628ECB;"></i>Password</label>
                            <input type="password" name="password" class="form-control " placeholder="Masukkan password" required>
                            @error('password')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-telephone-fill me-2" style="color: #628ECB;"></i>Nomor WhatsApp</label>
                            <input type="text" name="no_wa" class="form-control" placeholder="Contoh: 08123456789" value="{{ old('no_wa') }}" required>
                            @error('no_wa')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-geo-alt-fill me-2" style="color: #628ECB;"></i>Alamat</label>
                            <textarea name="alamat" class="form-control " placeholder="Masukkan alamat lengkap" rows="3" required>{{ old('alamat') }}</textarea>
                            @error('alamat')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button type="submit" class="btn " style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Simpan Data Pemilik
                            </button>
                            <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-secondary" style="flex: 0.5;">
                                <i class="bi bi-x me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
