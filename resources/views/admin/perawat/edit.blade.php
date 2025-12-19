@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.perawat.index') }}">Perawat</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4">
    {{-- Form Card --}}
    <div class="form-card">
        <div class="form-header">
            <h4><i class="bi bi-pencil-square me-2"></i>Form Edit Data Perawat</h4>
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

            <form action="{{ route('admin.perawat.update', $data->id_perawat) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Alamat --}}
                <div class="form-group">
                    <label class="form-label">
                        Alamat<span class="required">*</span>
                    </label>
                    <textarea name="alamat"
                              class="form-control-custom @error('alamat') is-invalid @enderror"
                              placeholder="Masukkan alamat lengkap"
                              required>{{ old('alamat', $data->alamat) }}</textarea>
                    @error('alamat')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- No HP --}}
                <div class="form-group">
                    <label class="form-label">
                        No HP<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('no_hp') is-invalid @enderror" 
                           name="no_hp" 
                           value="{{ old('no_hp', $data->no_hp) }}"
                           placeholder="Contoh: 08123456789"
                           required>
                    @error('no_hp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Jenis Kelamin --}}
                <div class="form-group">
                    <label class="form-label">
                        Jenis Kelamin<span class="required">*</span>
                    </label>
                    <select name="jenis_kelamin"
                            class="form-select-custom @error('jenis_kelamin') is-invalid @enderror"
                            required>
                        <option value="" disabled>-- Pilih Jenis Kelamin --</option>
                        <option value="L" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'L' ? 'selected' : '' }}>
                            Laki-laki
                        </option>
                        <option value="P" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'P' ? 'selected' : '' }}>
                            Perempuan
                        </option>
                    </select>
                    @error('jenis_kelamin')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pendidikan --}}
                <div class="form-group">
                    <label class="form-label">
                        Pendidikan<span class="required">*</span>
                    </label>
                    <input type="text" 
                           class="form-control-custom @error('pendidikan') is-invalid @enderror" 
                           name="pendidikan" 
                           value="{{ old('pendidikan', $data->pendidikan) }}"
                           placeholder="Contoh: S1 Keperawatan"
                           required>
                    @error('pendidikan')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Pilih User --}}
                <div class="form-group">
                    <label class="form-label">
                        Pilih User<span class="required">*</span>
                    </label>
                    <select name="id_user"
                            class="form-select-custom @error('id_user') is-invalid @enderror"
                            required>
                        <option value="" disabled>-- Pilih User --</option>
                        @foreach($user as $u)
                            <option value="{{ $u->iduser }}"
                                {{ old('id_user', $data->id_user) == $u->iduser ? 'selected' : '' }}>
                                {{ $u->nama }} ({{ $u->email }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_user')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.perawat.index') }}" class="btn-custom btn-cancel">
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