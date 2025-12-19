@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Edit</li>
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