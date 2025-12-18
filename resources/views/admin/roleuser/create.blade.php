@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roleuser.index') }}">Manajemen Role</a></li>
    <li class="breadcrumb-item active">Tambah Role</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-person-plus-fill"></i>
                    Tambah Role untuk {{ $user->nama }}
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.roleuser.store', $user->iduser) }}" method="POST">
                @csrf
                
                <div class="form-body">
                    {{-- Nama User --}}
                    <div class="input-group-wrapper">
                        <label class="form-label-custom">Nama User</label>
                        <input type="text" 
                               class="form-input-custom" 
                               value="{{ $user->nama }}" 
                               readonly>
                    </div>

                    {{-- Pilih Role --}}
                    <div class="input-group-wrapper">
                        <label for="idrole" class="form-label-custom">
                            Pilih Role<span class="required-star">*</span>
                        </label>
                        <select class="form-select-custom @error('idrole') is-invalid @enderror" 
                                id="idrole" 
                                name="idrole"
                                required>
                            <option value="">-- Pilih Role --</option>
                            @foreach($roles as $role)
                                @if(!in_array($role->idrole, $existingRoles))
                                    <option value="{{ $role->idrole }}" {{ old('idrole') == $role->idrole ? 'selected' : '' }}>
                                        {{ $role->nama_role }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                        @error('idrole')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>{{ $message }}
                            </div>
                        @else
                            <small class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Role yang sudah dimiliki tidak ditampilkan
                            </small>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.roleuser.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Batal
                    </a>

                    <button type="submit" class="btn-custom btn-save-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection