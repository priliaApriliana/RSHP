@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roleuser.index') }}">Manajemen Role</a></li>
    <li class="breadcrumb-item active">Edit Status</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">
            
            {{-- Header --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Status Role
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.roleuser.update', $roleUser->idrole_user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-body">
                    {{-- Info User --}}
                    <div class="input-group-wrapper">
                        <label class="form-label-custom">Nama User</label>
                        <input type="text" 
                               class="form-input-custom" 
                               value="{{ $roleUser->nama_user }}" 
                               readonly>
                    </div>

                    {{-- Info Role --}}
                    <div class="input-group-wrapper">
                        <label class="form-label-custom">Role</label>
                        <input type="text" 
                               class="form-input-custom" 
                               value="{{ $roleUser->nama_role }}" 
                               readonly>
                    </div>

                    {{-- Status --}}
                    <div class="input-group-wrapper">
                        <label for="status" class="form-label-custom">
                            Status<span class="required-star">*</span>
                        </label>
                        <select class="form-select-custom @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status"
                                required>
                            <option value="1" {{ old('status', $roleUser->status) == 1 ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $roleUser->status) == 0 ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>{{ $message }}
                            </div>
                        @enderror

                        <div class="info-alert">
                            <i class="bi bi-info-circle-fill"></i>
                            <span class="info-alert-text">Ubah status role user ini (Aktif/Nonaktif)</span>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.roleuser.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Perubahan
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection