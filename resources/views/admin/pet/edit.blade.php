@extends('layouts.lte.main')

@section('page-title', 'Edit Data Pet')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')
<style>
    .form-wrapper {
        max-width: 1100px;
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
    
    .alert-error {
        background: #ffffff;
        border: 2px solid #ff6b6b;
        border-left: 5px solid #d63031;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.25rem;
    }
    
    .alert-error-title {
        color: #d63031;
        font-size: 0.9375rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .alert-error ul {
        margin: 0;
        padding-left: 1.75rem;
        list-style: disc;
    }
    
    .alert-error li {
        color: #e74c3c;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
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
    
    .form-input-custom::placeholder {
        color: #95a5a6;
        font-weight: 400;
    }
    
    .form-input-custom.is-invalid,
    .form-select-custom.is-invalid {
        border-color: #e74c3c;
        background: #fff5f5;
    }
    
    .radio-group {
        display: flex;
        gap: 2rem;
        margin-top: 0.5rem;
    }
    
    .radio-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .radio-item input[type="radio"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    
    .radio-item label {
        font-weight: 600;
        color: #395886;
        cursor: pointer;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.375rem;
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
    
    .btn-update-custom {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: #ffffff;
        box-shadow: 0 4px 10px rgba(98, 142, 203, 0.3);
    }
    
    .btn-update-custom:hover {
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
                    <i class="bi bi-pencil-square"></i>
                    Edit Data Pet
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">
                    {{-- Error validation --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Terjadi kesalahan:
                            </div>
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-3">
                        {{-- Kolom Kiri --}}
                        <div class="col-md-6">
                            {{-- Nama Pet --}}
                            <div class="input-group-wrapper">
                                <label for="nama" class="form-label-custom">
                                    Nama Pet<span class="required-star">*</span>
                                </label>
                                <input type="text"
                                       id="nama"
                                       name="nama"
                                       class="form-input-custom @error('nama') is-invalid @enderror"
                                       value="{{ old('nama', $pet->nama) }}"
                                       placeholder="Contoh: Brownie"
                                       required>
                                @error('nama')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="input-group-wrapper">
                                <label for="tanggal_lahir" class="form-label-custom">
                                    Tanggal Lahir<span class="required-star">*</span>
                                </label>
                                <input type="date"
                                       id="tanggal_lahir"
                                       max="{{ date('Y-m-d') }}"
                                       name="tanggal_lahir"
                                       class="form-input-custom @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}"
                                       required>
                                @error('tanggal_lahir')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Warna/Tanda --}}
                            <div class="input-group-wrapper">
                                <label for="warna_tanda" class="form-label-custom">
                                    Warna / Tanda Khusus<span class="required-star">*</span>
                                </label>
                                <input type="text"
                                       id="warna_tanda"
                                       name="warna_tanda"
                                       class="form-input-custom @error('warna_tanda') is-invalid @enderror"
                                       value="{{ old('warna_tanda', $pet->warna_tanda) }}"
                                       placeholder="Contoh: Putih coklat"
                                       required>
                                @error('warna_tanda')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- Kolom Kanan --}}
                        <div class="col-md-6">
                            {{-- Jenis Kelamin --}}
                            <div class="input-group-wrapper">
                                <label class="form-label-custom">
                                    Jenis Kelamin<span class="required-star">*</span>
                                </label>
                                <div class="radio-group">
                                    <div class="radio-item">
                                        <input type="radio" name="jenis_kelamin" value="J" id="jantan_edit"
                                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'checked' : '' }}>
                                        <label for="jantan_edit">
                                            <i class="bi bi-gender-male text-primary"></i> Jantan
                                        </label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio" name="jenis_kelamin" value="B" id="betina_edit"
                                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'checked' : '' }}>
                                        <label for="betina_edit">
                                            <i class="bi bi-gender-female text-danger"></i> Betina
                                        </label>
                                    </div>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Pemilik --}}
                            <div class="input-group-wrapper">
                                <label for="idpemilik" class="form-label-custom">
                                    Pemilik<span class="required-star">*</span>
                                </label>
                                <select name="idpemilik"
                                        id="idpemilik"
                                        class="form-select-custom @error('idpemilik') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($pemilik as $p)
                                        <option value="{{ $p->idpemilik }}"
                                            {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                            {{ $p->nama_pemilik }} - {{ $p->no_wa }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('idpemilik')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>

                            {{-- Ras Hewan --}}
                            <div class="input-group-wrapper">
                                <label for="idras_hewan" class="form-label-custom">
                                    Ras Hewan<span class="required-star">*</span>
                                </label>
                                <select name="idras_hewan"
                                        id="idras_hewan"
                                        class="form-select-custom @error('idras_hewan') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    @foreach($ras as $r)
                                        <option value="{{ $r->idras_hewan }}"
                                            {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                            {{ $r->nama_ras }} ({{ $r->nama_jenis_hewan }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('idras_hewan')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.pet.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit" class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Update Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection