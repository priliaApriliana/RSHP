@extends('layouts.lte.main')

@section('page-title', 'Edit Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
    <li class="breadcrumb-item active">Edit</li>
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Pemilik</h5>
                </div>
                <form action="{{ route('resepsionis.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="card-body">
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

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-person-fill me-2" style="color: #628ECB;"></i>Nama Pemilik</label>
                            <input type="text" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                   placeholder="Masukkan nama pemilik" value="{{ old('nama', $pemilik->nama) }}" required>
                            @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-envelope-fill me-2" style="color: #628ECB;"></i>Email</label>
                            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" 
                                   placeholder="Masukkan email" value="{{ old('email', $pemilik->email) }}" required>
                            @error('email')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-telephone-fill me-2" style="color: #628ECB;"></i>No. WhatsApp</label>
                            <input type="text" name="no_wa" class="form-control form-control-lg @error('no_wa') is-invalid @enderror" 
                                   placeholder="Contoh: 08123456789" value="{{ old('no_wa', $pemilik->no_wa) }}" required>
                            @error('no_wa')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-geo-alt-fill me-2" style="color: #628ECB;"></i>Alamat</label>
                            <textarea name="alamat" class="form-control form-control-lg @error('alamat') is-invalid @enderror" 
                                      placeholder="Masukkan alamat lengkap" rows="3" required>{{ old('alamat', $pemilik->alamat) }}</textarea>
                            @error('alamat')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="card-footer border-top" style="background-color: #F0F3FA;">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-lg btn-secondary" style="flex: 0.5;">
                                <i class="bi bi-x me-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
