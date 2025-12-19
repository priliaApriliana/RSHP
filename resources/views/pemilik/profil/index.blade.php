@extends('layouts.lte.main')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 12px;
        color: white;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.2);
    }
    
    .page-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .page-header p {
        opacity: 0.9;
        margin-bottom: 0;
        font-size: 0.875rem;
    }
    
    .profile-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
    }
    
    .profile-avatar {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        margin: 0 auto 1rem;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.25);
    }
    
    .profile-name {
        text-align: center;
        font-size: 1.25rem;
        font-weight: 600;
        color: #395886;
        margin-bottom: 1.25rem;
    }
    
    .form-label {
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .form-label i {
        font-size: 0.875rem;
    }
    
    .form-control {
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.625rem 0.875rem;
        transition: all 0.3s ease;
        font-size: 0.875rem;
    }
    
    .form-control:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 0.15rem rgba(98, 142, 203, 0.15);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 3px 10px rgba(98, 142, 203, 0.3);
    }
    
    .btn-secondary {
        background: #F0F3FA;
        color: #395886;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        padding: 0.625rem 1.5rem;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #E3E9F5;
        color: #395886;
        border-color: #628ECB;
    }
    
    .info-box {
        background: #F0F3FA;
        border-left: 3px solid #628ECB;
        border-radius: 8px;
        padding: 0.875rem;
        margin-bottom: 1.25rem;
        font-size: 0.8125rem;
    }
    
    .info-box i {
        color: #628ECB;
        font-size: 1rem;
        margin-right: 0.5rem;
    }
    
    .section-divider {
        border-top: 1px solid #e2e8f0;
        margin: 1.5rem 0;
    }
    
    .section-title {
        font-size: 1rem;
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title i {
        font-size: 1rem;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
        padding: 0.875rem;
        font-size: 0.875rem;
        margin-bottom: 0.875rem;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
    }

    .alert-warning {
        background: #FFF3CD;
        color: #856404;
        border-left: 3px solid #FFC107;
    }

    .alert ul {
        margin-bottom: 0;
        padding-left: 1.25rem;
    }

    .alert i {
        margin-right: 0.375rem;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-9">
            <h1><i class="bi bi-person-circle"></i> Profil Saya</h1>
            <p>Kelola informasi akun dan data pribadi Anda</p>
        </div>
        <div class="col-md-3 text-end d-none d-md-block">
            <i class="bi bi-gear-fill" style="font-size: 3rem; opacity: 0.25;"></i>
        </div>
    </div>
</div>

<!-- Alert Success -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Alert Error -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <strong>Terjadi kesalahan:</strong>
    <ul class="mt-2">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Profile Card -->
<div class="profile-card">
    <!-- Avatar -->
    <div class="profile-avatar">
        <i class="bi bi-person-fill"></i>
    </div>
    
    <div class="profile-name">
        {{ $pemilik->nama }}
    </div>

    <!-- Info Box -->
    <div class="info-box">
        <i class="bi bi-info-circle-fill"></i>
        <strong>Informasi:</strong> Pastikan data yang Anda masukkan valid dan terkini untuk memudahkan komunikasi.
    </div>

    <!-- Form Update Profile -->
    <form action="{{ route('pemilik.profil.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <!-- Nama Lengkap -->
            <div class="col-md-6 mb-3">
                <label for="nama" class="form-label">
                    <i class="bi bi-person-fill"></i> Nama Lengkap
                </label>
                <input 
                    type="text" 
                    class="form-control @error('nama') is-invalid @enderror" 
                    id="nama" 
                    name="nama" 
                    value="{{ old('nama', $pemilik->nama) }}" 
                    required
                >
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope-fill"></i> Email
                </label>
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email', $pemilik->email) }}" 
                    required
                >
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- No. WhatsApp -->
            <div class="col-md-6 mb-3">
                <label for="no_wa" class="form-label">
                    <i class="bi bi-whatsapp"></i> No. WhatsApp
                </label>
                <input 
                    type="text" 
                    class="form-control @error('no_wa') is-invalid @enderror" 
                    id="no_wa" 
                    name="no_wa" 
                    value="{{ old('no_wa', $pemilik->no_wa) }}" 
                    placeholder="Contoh: 081234567890"
                >
                @error('no_wa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Alamat -->
            <div class="col-md-6 mb-3">
                <label for="alamat" class="form-label">
                    <i class="bi bi-geo-alt-fill"></i> Alamat
                </label>
                <textarea 
                    class="form-control @error('alamat') is-invalid @enderror" 
                    id="alamat" 
                    name="alamat" 
                    rows="3"
                    placeholder="Masukkan alamat lengkap"
                >{{ old('alamat', $pemilik->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Section Divider -->
        <div class="section-divider"></div>

        <!-- Password Section -->
        <div class="section-title">
            <i class="bi bi-shield-lock-fill"></i> Ubah Password
        </div>
        
        <div class="alert alert-warning">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <small>Kosongkan jika tidak ingin mengubah password</small>
        </div>

        <div class="row">
            <!-- Password Baru -->
            <div class="col-md-6 mb-3">
                <label for="password" class="form-label">
                    <i class="bi bi-key-fill"></i> Password Baru
                </label>
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Minimal 6 karakter"
                >
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Konfirmasi Password -->
            <div class="col-md-6 mb-3">
                <label for="password_confirmation" class="form-label">
                    <i class="bi bi-key-fill"></i> Konfirmasi Password
                </label>
                <input 
                    type="password" 
                    class="form-control" 
                    id="password_confirmation" 
                    name="password_confirmation" 
                    placeholder="Ketik ulang password baru"
                >
            </div>
        </div>

        <!-- Buttons -->
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('pemilik.dashboard') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Simpan Perubahan
            </button>
        </div>
    </form>
</div>

@endsection