@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.temudokter.index') }}">Temu Dokter</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-calendar-check-fill me-2"></i>Form Daftar Temu Dokter</h5>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0" style="background-color: rgba(98, 142, 203, 0.1); color: #628ECB;">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
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

                    <form action="{{ route('resepsionis.temudokter.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-heart me-2" style="color: #628ECB;"></i>Nama Hewan</label>
                            <select name="idpet" class="form-select @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Hewan --</option>
                                @foreach ($pet as $p)
                                    <option value="{{ $p->idpet }}" {{ old('idpet') == $p->idpet ? 'selected' : '' }}>
                                        {{ $p->nama }} - Pemilik: {{ $p->pemilik->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-stethoscope me-2" style="color: #628ECB;"></i>Pilih Dokter</label>
                            <select name="idrole_user" class="form-select @error('idrole_user') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach ($dokter as $d)
                                    <option value="{{ $d->idrole_user }}" {{ old('idrole_user') == $d->idrole_user ? 'selected' : '' }}>
                                        dr. {{ $d->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idrole_user')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="d-flex gap-2 mt-4">
                            <button class="btn" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Daftarkan
                            </button>
                            <a href="{{ route('resepsionis.temudokter.index') }}" class="btn btn-secondary" style="flex: 0.5;">
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
