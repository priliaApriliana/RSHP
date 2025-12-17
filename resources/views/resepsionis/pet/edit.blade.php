@extends('layouts.lte.main')

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
    
    .form-wrapper {
        max-width: 750px;
        margin: 0 auto;
    }
    
    .form-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(57, 88, 134, 0.1);
        overflow: hidden;
        border: 1px solid #D5DEEF;
    }
    
    .form-header {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        padding: 1.25rem 1.5rem;
        border-bottom: none;
    }
    
    .form-header h5 {
        color: #ffffff;
        font-size: 1.125rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-body {
        padding: 1.75rem 1.5rem;
        background: #F8FAFC;
    }
    
    .alert-danger {
        background: #ffffff;
        border: 2px solid #ff6b6b;
        border-left: 4px solid #d63031;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }
    
    .form-group {
        margin-bottom: 1.25rem;
    }
    
    .form-label {
        color: #395686;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
    
    .form-label i {
        color: #628ECB;
        font-size: 0.9375rem;
    }
    
    .form-control, .form-select {
        border: 2px solid #D5DEEF;
        border-radius: 8px;
        padding: 0.625rem 0.875rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: #ffffff;
        height: auto;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 3px rgba(98, 142, 203, 0.15);
        outline: none;
        background: #ffffff;
    }
    
    .form-control::placeholder {
        color: #95a5a6;
        font-size: 0.8125rem;
    }
    
    .form-control[readonly] {
        background: #F0F3FA;
        color: #628ECB;
        cursor: not-allowed;
    }
    
    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.8125rem;
        margin-top: 0.375rem;
        font-weight: 500;
    }
    
    .is-invalid {
        border-color: #e74c3c;
        background: #fff5f5;
    }
    
    .form-footer {
        background: linear-gradient(to right, #F0F3FA 0%, #ffffff 100%);
        padding: 1.25rem 1.5rem;
        border-top: 2px solid #D5DEEF;
        display: flex;
        gap: 0.75rem;
    }
    
    .btn-custom {
        padding: 0.625rem 1.5rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
    }
    
    .btn-submit {
        background: linear-gradient(135deg, #628ECB 0%, #395686 100%);
        color: #ffffff;
        flex: 1;
        justify-content: center;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.3);
    }
    
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.4);
        color: #ffffff;
    }
    
    .btn-cancel {
        background: #ffffff;
        color: #6c757d;
        border: 2px solid #dee2e6;
    }
    
    .btn-cancel:hover {
        background: #6c757d;
        color: #ffffff;
        border-color: #6c757d;
    }
    
    .btn-custom i {
        font-size: 1rem;
    }

    /* Alert Styling */
    .alert-danger ul {
        margin: 0.5rem 0 0 1.25rem;
        padding: 0;
    }

    .alert-danger li {
        margin-bottom: 0.25rem;
    }

    /* Select Styling */
    .form-select {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23628ECB' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }
</style>

<div class="container-fluid px-4">
    <div class="form-wrapper">
        <div class="form-card">
            {{-- HEADER --}}
            <div class="form-header">
                <h5>
                    <i class="bi bi-pencil-square"></i>
                    Edit Pet
                </h5>
            </div>

            {{-- FORM --}}
            <form action="{{ route('resepsionis.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="form-body">
                    {{-- Error Alert --}}
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-exclamation-circle me-2"></i><strong>Validasi Error!</strong>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Hewan --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-heart"></i>
                            Nama Hewan
                        </label>
                        <input type="text" 
                               name="nama" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               placeholder="Masukkan nama hewan" 
                               value="{{ old('nama', $pet->nama) }}" 
                               required>
                        @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Pemilik --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-person-fill"></i>
                            Pemilik
                        </label>
                        <select name="idpemilik" 
                                class="form-select @error('idpemilik') is-invalid @enderror" 
                                required>
                            <option value="">-- Pilih Pemilik --</option>
                            @foreach($pemilik as $p)
                                <option value="{{ $p->idpemilik }}" 
                                        {{ old('idpemilik', $pet->idpemilik) == $p->idpemilik ? 'selected' : '' }}>
                                    {{ $p->user->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('idpemilik')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Jenis Hewan (Readonly) --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-tags"></i>
                            Jenis Hewan
                        </label>
                        <input type="text" 
                               class="form-control"
                               value="{{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}"
                               readonly>
                    </div>

                    {{-- Ras Hewan --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-collection"></i>
                            Ras Hewan
                        </label>
                        <select name="idras_hewan" 
                                class="form-select @error('idras_hewan') is-invalid @enderror" 
                                required>
                            <option value="">-- Pilih Ras --</option>
                            @foreach($rasHewan as $r)
                                <option value="{{ $r->idras_hewan }}" 
                                        {{ old('idras_hewan', $pet->idras_hewan) == $r->idras_hewan ? 'selected' : '' }}>
                                    {{ $r->jenisHewan->nama_jenis_hewan }} - {{ $r->nama_ras }}
                                </option>
                            @endforeach
                        </select>
                        @error('idras_hewan')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Jenis Kelamin --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-gender-ambiguous"></i>
                            Jenis Kelamin
                        </label>
                        <select name="jenis_kelamin" 
                                class="form-select @error('jenis_kelamin') is-invalid @enderror" 
                                required>
                            <option value="">-- Pilih --</option>
                            <option value="J" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'selected' : '' }}>
                                Jantan
                            </option>
                            <option value="B" {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'selected' : '' }}>
                                Betina
                            </option>
                        </select>
                        @error('jenis_kelamin')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-calendar-fill"></i>
                            Tanggal Lahir
                        </label>
                        <input type="date" 
                               name="tanggal_lahir" 
                               class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                               value="{{ old('tanggal_lahir', \Carbon\Carbon::parse($pet->tanggal_lahir)->format('Y-m-d')) }}" 
                               required>
                        @error('tanggal_lahir')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Warna/Tanda Khusus --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="bi bi-palette"></i>
                            Warna/Tanda Khusus
                        </label>
                        <input type="text" 
                               name="warna_tanda" 
                               class="form-control @error('warna_tanda') is-invalid @enderror" 
                               placeholder="Contoh: bintik putih di dahi" 
                               value="{{ old('warna_tanda', $pet->warna_tanda) }}">
                        @error('warna_tanda')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <button type="submit" class="btn-custom btn-submit">
                        <i class="bi bi-save"></i>
                        Simpan Perubahan
                    </button>
                    <a href="{{ route('resepsionis.pet.index') }}" class="btn-custom btn-cancel">
                        <i class="bi bi-x-circle"></i>
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection