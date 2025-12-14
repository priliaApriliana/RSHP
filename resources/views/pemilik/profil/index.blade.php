@extends('layouts.lte.main')

@section('page-title', 'Profil Saya')

@section('content')

<style>
    .profile-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 15px;
        color: white;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.3);
    }
    
    .profile-header h2 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .profile-card {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
        margin-bottom: 2rem;
    }
    
    .profile-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #8AAEE0 0%, #628ECB 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        color: white;
        margin: 0 auto 1.5rem;
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.3);
    }
    
    .form-label {
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }
    
    .form-control {
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        padding: 0.75rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 0.2rem rgba(98, 142, 203, 0.25);
    }
    
    .btn-primary {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border: none;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(98, 142, 203, 0.4);
    }
    
    .btn-secondary {
        background: #F0F3FA;
        color: #395886;
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        padding: 0.75rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-secondary:hover {
        background: #E3E9F5;
        color: #395886;
        border-color: #628ECB;
    }
    
    .info-box {
        background: #F0F3FA;
        border-left: 4px solid #628ECB;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .info-box i {
        color: #628ECB;
        font-size: 20px;
        margin-right: 10px;
    }
    
    .section-divider {
        border-top: 2px solid #D5DEEF;
        margin: 2rem 0;
    }
    
    .alert {
        border-radius: 8px;
        border: none;
    }
    
    .alert-success {
        background: #d4edda;
        color: #155724;
    }
</style>

<!-- Profile Header -->
<div class="profile-header">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2><i class="bi bi-person-circle"></i> Profil Saya</h2>
            <p class="mb-0">Kelola informasi akun dan data pribadi Anda</p>
        </div>
        <div class="col-md-4 text-end d-none d-md-block">
            <i class="bi bi-gear-fill" style="font-size: 80px; opacity: 0.3;"></i>
        </div>
    </div>
</div>

<!-- Alert Success -->
@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle-fill me-2"></i>
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<!-- Alert Error -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <strong>Terjadi kesalahan:</strong>
    <ul class="mb-0 mt-2">
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
    
    <h4 class="text-center mb-4" style="color: #395886; font-weight: 600;">
        {{ $pemilik->nama }}
    </h4>

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
        <h5 class="mb-3" style="color: #395886; font-weight: 600;">
            <i class="bi bi-shield-lock-fill"></i> Ubah Password
        </h5>
        
        <div class="alert" style="background: #FFF3CD; color: #856404; border-left: 4px solid #FFC107;">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
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
        <div class="d-flex justify-content-between mt-4">
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