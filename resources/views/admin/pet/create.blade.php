@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Tambah</li>
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
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Data Pet
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf

                <div class="form-body">
                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                Terdapat kesalahan:
                            </div>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
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
                                       placeholder="Contoh: Brownie"
                                       value="{{ old('nama') }}"
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
                                       name="tanggal_lahir" 
                                       class="form-input-custom @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir') }}"
                                       max="{{ date('Y-m-d') }}"
                                       required>
                                @error('tanggal_lahir')
                                    <div class="error-message">
                                        <i class="bi bi-x-circle-fill"></i>{{ $message }}
                                    </div>
                                @else
                                    <small class="helper-text">Tanggal tidak boleh melebihi hari ini</small>
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
                                       placeholder="Contoh: Putih bercorak hitam"
                                       value="{{ old('warna_tanda') }}"
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
                                        <input type="radio"
                                               name="jenis_kelamin"
                                               value="J"
                                               id="jantan"
                                               {{ old('jenis_kelamin') == 'J' ? 'checked' : '' }}
                                               required>
                                        <label for="jantan">
                                            <i class="bi bi-gender-male text-primary"></i> Jantan
                                        </label>
                                    </div>
                                    <div class="radio-item">
                                        <input type="radio"
                                               name="jenis_kelamin"
                                               value="B"
                                               id="betina"
                                               {{ old('jenis_kelamin') == 'B' ? 'checked' : '' }}
                                               required>
                                        <label for="betina">
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
                                <select id="idpemilik"
                                        name="idpemilik"
                                        class="form-select-custom @error('idpemilik') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Pemilik --</option>
                                    @foreach ($pemilik as $pmk)
                                        <option value="{{ $pmk->idpemilik }}"
                                            {{ old('idpemilik') == $pmk->idpemilik ? 'selected' : '' }}>
                                            {{ $pmk->nama_pemilik }} - {{ $pmk->no_wa }}
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
                                <select id="idras_hewan"
                                        name="idras_hewan"
                                        class="form-select-custom @error('idras_hewan') is-invalid @enderror"
                                        required>
                                    <option value="">-- Pilih Ras Hewan --</option>
                                    @foreach ($ras as $rs)
                                        <option value="{{ $rs->idras_hewan }}"
                                            {{ old('idras_hewan') == $rs->idras_hewan ? 'selected' : '' }}>
                                            {{ $rs->nama_ras }} ({{ $rs->nama_jenis_hewan }})
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

                    <button type="submit" class="btn-custom btn-save-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Simpan Data
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@endsection