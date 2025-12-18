@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="form-wrapper">
    <div class="form-card">
        
        {{-- HEADER --}}
        <div class="form-header">
            <h3 class="form-header-title">
                <i class="bi bi-user-md"></i>
                Form Tambah Dokter
            </h3>
        </div>

        {{-- BODY --}}
        <div class="form-body">

            {{-- ERROR MESSAGES --}}
            @if ($errors->any())
            <div class="alert-error">
                <div class="alert-error-title">
                    <i class="bi bi-exclamation-circle"></i>
                    Terdapat kesalahan input
                </div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('admin.dokter.store') }}" method="POST" id="formDokter">
                @csrf

                {{-- ALAMAT --}}
                <div class="input-group-wrapper">
                    <label class="form-label-custom">
                        Alamat
                        <span class="required-star">*</span>
                    </label>
                    <textarea 
                        name="alamat" 
                        class="form-textarea-custom @error('alamat') is-invalid @enderror" 
                        placeholder="Masukkan alamat lengkap dokter"
                        rows="3"
                        required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- NO HP --}}
                <div class="input-group-wrapper">
                    <label class="form-label-custom">
                        No HP
                        <span class="required-star">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="no_hp" 
                        class="form-input-custom @error('no_hp') is-invalid @enderror" 
                        value="{{ old('no_hp') }}"
                        placeholder="Contoh: 081234567890"
                        required>
                    @error('no_hp')
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="helper-text">
                        <i class="bi bi-info-circle"></i>
                        Format: 08xxxxxxxxxx
                    </div>
                </div>

                {{-- BIDANG DOKTER --}}
                <div class="input-group-wrapper">
                    <label class="form-label-custom">
                        Bidang Dokter
                        <span class="required-star">*</span>
                    </label>
                    <input 
                        type="text" 
                        name="bidang_dokter" 
                        class="form-input-custom @error('bidang_dokter') is-invalid @enderror" 
                        value="{{ old('bidang_dokter') }}"
                        placeholder="Contoh: Bedah, Penyakit Dalam, dll"
                        required>
                    @error('bidang_dokter')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- JENIS KELAMIN --}}
                <div class="input-group-wrapper">
                    <label class="form-label-custom">
                        Jenis Kelamin
                        <span class="required-star">*</span>
                    </label>
                    <div class="radio-group">
                        <div class="radio-item">
                            <input 
                                type="radio" 
                                id="laki" 
                                name="jenis_kelamin" 
                                value="L" 
                                {{ old('jenis_kelamin') == 'L' ? 'checked' : '' }}
                                required>
                            <label for="laki">
                                <i class="bi bi-mars"></i> Laki-laki
                            </label>
                        </div>
                        <div class="radio-item">
                            <input 
                                type="radio" 
                                id="perempuan" 
                                name="jenis_kelamin" 
                                value="P" 
                                {{ old('jenis_kelamin') == 'P' ? 'checked' : '' }}
                                required>
                            <label for="perempuan">
                                <i class="bi bi-venus"></i> Perempuan
                            </label>
                        </div>
                    </div>
                    @error('jenis_kelamin')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                {{-- USER --}}
                <div class="input-group-wrapper">
                    <label class="form-label-custom">
                        User
                        <span class="required-star">*</span>
                    </label>
                    <select 
                        name="id_user" 
                        class="form-select-custom @error('id_user') is-invalid @enderror" 
                        required>
                        <option value="">-- Pilih User --</option>
                        @foreach($user as $u)
                        <option value="{{ $u->iduser }}" {{ old('id_user') == $u->iduser ? 'selected' : '' }}>
                            {{ $u->nama }} ({{ $u->email }})
                        </option>
                        @endforeach
                    </select>
                    @error('id_user')
                    <div class="error-message">
                        <i class="bi bi-exclamation-circle"></i>
                        {{ $message }}
                    </div>
                    @enderror
                    <div class="helper-text">
                        <i class="bi bi-info-circle"></i>
                        Pilih user yang akan dijadikan akun dokter
                    </div>
                </div>

            </form>

        </div>

        {{-- FOOTER --}}
        <div class="form-footer">
            <a href="{{ route('admin.dokter.index') }}" class="btn-custom btn-back-custom">
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
            <button type="submit" form="formDokter" class="btn-custom btn-save-custom">
                <i class="bi bi-save"></i>
                Simpan Data
            </button>
        </div>

    </div>
</div>

@endsection