@extends('layouts.lte.main')

@section('page-title', 'Edit Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pet.index') }}">Pet</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Pet</h5>
                </div>
                <form action="{{ route('resepsionis.pet.update', $pet->idpet) }}" method="POST">
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
                            <label class="form-label"><i class="bi bi-heart me-2" style="color: #628ECB;"></i>Nama Hewan</label>
                            <input type="text" name="nama" class="form-control form-control-lg @error('nama') is-invalid @enderror" 
                                   placeholder="Masukkan nama hewan" value="{{ old('nama', $pet->nama) }}" required>
                            @error('nama')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-person-fill me-2" style="color: #628ECB;"></i>Pemilik</label>
                            <select name="idpemilik" class="form-select form-select-lg @error('idpemilik') is-invalid @enderror" required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemilik as $p)
                                    <option value="{{ $p->idpemilik }}" {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                        {{ $p->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-collection me-2" style="color: #628ECB;"></i>Ras Hewan</label>
                            <select name="idras_hewan" class="form-select form-select-lg @error('idras_hewan') is-invalid @enderror" required>
                                <option value="">-- Pilih Ras --</option>
                                @foreach($rasHewan as $r)
                                    <option value="{{ $r->idras_hewan }}" {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                        {{ $r->jenisHewan->nama_jenis_hewan }} - {{ $r->nama_ras }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-gender-ambiguous me-2" style="color: #628ECB;"></i>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-select form-select-lg @error('jenis_kelamin') is-invalid @enderror" required>
                                <option value="">-- Pilih --</option>
                                <option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('jenis_kelamin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-calendar-fill me-2" style="color: #628ECB;"></i>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" class="form-control form-control-lg @error('tanggal_lahir') is-invalid @enderror" 
                                   value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}" required>
                            @error('tanggal_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-palette me-2" style="color: #628ECB;"></i>Warna/Tanda Khusus</label>
                            <input type="text" name="warna_tanda" class="form-control form-control-lg @error('warna_tanda') is-invalid @enderror" 
                                   placeholder="Contoh: bintik putih di dahi" value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                            @error('warna_tanda')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="card-footer border-top" style="background-color: #F0F3FA;">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-lg btn-secondary" style="flex: 0.5;">
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
