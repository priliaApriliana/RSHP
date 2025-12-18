@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="form-container">
    <div class="card form-card">

        {{-- CARD HEADER --}}
        <div class="card-header">
            <h3 class="card-title">
                <i class="bi bi-person-plus-fill"></i> Tambah Pemilik
            </h3>
        </div>

        {{-- FORM --}}
        <form action="{{ route('admin.pemilik.store') }}" method="POST">
            @csrf

            <div class="card-body">

                {{-- Notifikasi Error --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong><i class="bi bi-exclamation-triangle-fill"></i> Terjadi kesalahan:</strong>
                        <ul class="mt-2 mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Nomor WhatsApp --}}
                <div class="mb-3">
                    <label for="no_wa" class="form-label">
                        <i class="bi bi-whatsapp"></i> Nomor WhatsApp <span class="text-danger">*</span>
                    </label>

                    <input type="text"
                           id="no_wa"
                           name="no_wa"
                           class="form-control @error('no_wa') is-invalid @enderror"
                           placeholder="Contoh: 08123456789 atau +628123456789"
                           value="{{ old('no_wa') }}"
                           required>

                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">
                        <i class="bi bi-house-fill"></i> Alamat <span class="text-danger">*</span>
                    </label>
                    
                    <textarea id="alamat"
                              name="alamat"
                              rows="3"
                              class="form-control @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat') }}</textarea>

                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih User --}}
                <div class="mb-3">
                    <label for="iduser" class="form-label">
                        <i class="bi bi-person-fill"></i> Pilih User <span class="text-danger">*</span>
                    </label>

                    <select id="iduser"
                            name="iduser"
                            class="form-select @error('iduser') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->iduser }}"
                                {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>

                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

            </div>

            {{-- CARD FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>
            </div>

        </form>

    </div>
</div>

@endsection