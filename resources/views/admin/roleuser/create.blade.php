@extends('layouts.lte.main')

@section('page-title', 'Tambah Role untuk ' . $user->nama)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roleuser.index') }}">Manajemen Role</a></li>
    <li class="breadcrumb-item active">Tambah Role</li>
@endsection

@section('content')
<style>
    .form-wrapper {
        max-width: 900px;
        margin: 0;
        margin-left: 2rem;
        margin-right: auto;
    }
    
    .form-card {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 2px 12px rgba(57, 88, 134, 0.1);
        overflow: hidden;
        border: 1px solid #D5DEEF;
    }
    
    .form-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        padding: 1.5rem 2rem;
        border-bottom: 3px solid #395886;
    }
    
    .form-header-title {
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.625rem;
    }
    
    .form-header-title i {
        font-size: 1.375rem;
    }
    
    .form-body {
        padding: 1.5rem;
        background: #F8FAFC;
    }
    
    .input-group-wrapper {
        background: #ffffff;
        padding: 1.25rem;
        border-radius: 12px;
        border: 2px solid #D5DEEF;
        margin-bottom: 1rem;
    }
    
    .form-label-custom {
        display: block;
        font-weight: 700;
        color: #395886;
        margin-bottom: 0.5rem;
        font-size: 0.9375rem;
    }
    
    .required-star {
        color: #d63031;
        margin-left: 0.25rem;
    }
    
    .form-input-custom,
    .form-select-custom {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #D5DEEF;
        border-radius: 10px;
        font-size: 0.9375rem;
        transition: all 0.3s ease;
        background: #ffffff;
        color: #2c3e50;
        font-weight: 500;
    }
    
    .form-input-custom:focus,
    .form-select-custom:focus {
        border-color: #628ECB;
        box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.15);
        outline: none;
    }
    
    .form-input-custom:read-only {
        background: #F0F3FA;
        color: #7d8da1;
    }
    
    .form-input-custom.is-invalid,
    .form-select-custom.is-invalid {
        border-color: #e74c3c;
        background: #fff5f5;
    }
    
    .error-message {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        color: #e74c3c;
        font-size: 0.8125rem;
        margin-top: 0.5rem;
        font-weight: 600;
    }
    
    .helper-text {
        font-size: 0.8125rem;
        color: #628ECB;
        margin-top: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }
    
    .form-footer {
        background: linear-gradient(to right, #F0F3FA 0%, #ffffff 100%);
        padding: 1.5rem 2rem;
        border-top: 2px solid #D5DEEF;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .btn-custom {
        padding: 0.75rem 1.75rem;
        border-radius: 10px;
        font-size: 0.9375rem;
        font-weight: 700;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .btn-back-custom {
        background: #ffffff;
        color: #628ECB;
        border: 2px solid #628ECB;
    }
    
    .btn-back-custom:hover {
        background: #628ECB;
        color: #ffffff;
        transform: translateX(-3px);
        box-shadow: 0 4px 8px rgba(98, 142, 203, 0.3);
    }
    
    .btn-save-custom {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(98, 142, 203, 0.3);
    }
    
    .btn-save-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(98, 142, 203, 0.4);
        color: #ffffff;
    }
</style>

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