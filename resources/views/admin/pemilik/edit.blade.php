@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    {{-- Page Header --}}
    <div class="form-card">
        <div class="form-header">
            <h4><i class="bi bi-pencil-square me-2"></i>Form Edit Data Pemilik</h4>
        </div>

        <div class="form-body">
            {{-- Error Alert --}}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Nomor WhatsApp --}}
                <div class="form-group">
                    <label class="form-label">
                        Nomor WhatsApp<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('no_wa') is-invalid @enderror" 
                           name="no_wa" 
                           value="{{ old('no_wa', $pemilik->no_wa) }}"
                           placeholder="Contoh: 08123456789"
                           required>
                    @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Alamat --}}
                <div class="form-group">
                    <label class="form-label">
                        Alamat<span class="required">*</span>
                    </label>
                    <textarea name="alamat"
                              class="form-control-custom @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat', $pemilik->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih User --}}
                <div class="form-group">
                    <label class="form-label">
                        Pilih User<span class="required">*</span>
                    </label>
                    <select name="iduser"
                            class="form-select-custom @error('iduser') is-invalid @enderror"
                            required>
                        <option value="" disabled>-- Pilih User --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->iduser }}"
                                {{ old('iduser', $pemilik->iduser) == $user->iduser ? 'selected' : '' }}>
                                {{ $user->nama }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('iduser')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>
                    <button type="submit" class="btn-custom btn-update">
                        <i class="bi bi-check-circle"></i>
                        Update Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection