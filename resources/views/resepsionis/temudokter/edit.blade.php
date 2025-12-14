@extends('layouts.lte.main')

@section('page-title', 'Edit Temu Dokter')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.temudokter.index') }}">Temu Dokter</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Edit Temu Dokter</h5>
                </div>
                <form action="{{ route('resepsionis.temudokter.update', $temuDokter->idreservasi_dokter) }}" method="POST">
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
                            <label class="form-label"><i class="bi bi-hash me-2" style="color: #628ECB;"></i>No. Urut</label>
                            <input type="text" class="form-control form-control-lg" value="{{ $temuDokter->no_urut }}" disabled style="background-color: #F0F3FA;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-calendar-fill me-2" style="color: #628ECB;"></i>Waktu Daftar</label>
                            <input type="datetime-local" class="form-control form-control-lg" value="{{ $temuDokter->waktu_daftar }}" disabled style="background-color: #F0F3FA;">
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-heart me-2" style="color: #628ECB;"></i>Hewan</label>
                            <select name="idpet" class="form-select form-select-lg @error('idpet') is-invalid @enderror" required>
                                <option value="">-- Pilih Hewan --</option>
                                @foreach($pet as $p)
                                    <option value="{{ $p->idpet }}" {{ old('idpet', $temuDokter->idpet) == $p->idpet ? 'selected' : '' }}>
                                        {{ $p->nama }} ({{ $p->nama_pemilik }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idpet')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-stethoscope me-2" style="color: #628ECB;"></i>Dokter</label>
                            <select name="idrole_user" class="form-select form-select-lg @error('idrole_user') is-invalid @enderror" required>
                                <option value="">-- Pilih Dokter --</option>
                                @foreach($dokter as $d)
                                    <option value="{{ $d->idrole_user }}" {{ old('idrole_user', $temuDokter->idrole_user) == $d->idrole_user ? 'selected' : '' }}>
                                        dr. {{ $d->user->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idrole_user')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label"><i class="bi bi-info-circle me-2" style="color: #628ECB;"></i>Status</label>
                            <select name="status" class="form-select form-select-lg @error('status') is-invalid @enderror" required>
                                <option value="">-- Pilih Status --</option>
                                <option value="A" {{ old('status', $temuDokter->status) == 'A' ? 'selected' : '' }}>Aktif</option>
                                <option value="S" {{ old('status', $temuDokter->status) == 'S' ? 'selected' : '' }}>Selesai</option>
                                <option value="B" {{ old('status', $temuDokter->status) == 'B' ? 'selected' : '' }}>Batal</option>
                            </select>
                            @error('status')<span class="invalid-feedback">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div class="card-footer border-top" style="background-color: #F0F3FA;">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-lg" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Simpan
                            </button>
                            <a href="{{ route('resepsionis.temudokter.index') }}" class="btn btn-lg btn-secondary" style="flex: 0.5;">
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
