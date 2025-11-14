@extends('layouts.lte.main')

@section('page-title', 'Tambah Data Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 offset-md-1">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Data Pet
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- ERROR VALIDATION --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row">

                        {{-- KOLOM KIRI --}}
                        <div class="col-md-6">

                            {{-- Nama Pet --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Pet <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="nama"
                                       name="nama" 
                                       class="form-control @error('nama') is-invalid @enderror"
                                       placeholder="Contoh: Brownie"
                                       value="{{ old('nama') }}"
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">Tanggal Lahir <span class="text-danger">*</span></label>
                                <input type="date" 
                                       id="tanggal_lahir"
                                       name="tanggal_lahir" 
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir') }}"
                                       max="{{ date('Y-m-d') }}"
                                       required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Tanggal tidak boleh melebihi hari ini.</small>
                            </div>

                            {{-- Warna/Tanda --}}
                            <div class="mb-3">
                                <label for="warna_tanda" class="form-label">Warna / Tanda Khusus <span class="text-danger">*</span></label>
                                <input type="text" 
                                       id="warna_tanda"
                                       name="warna_tanda" 
                                       class="form-control @error('warna_tanda') is-invalid @enderror"
                                       placeholder="Contoh: Putih bercorak hitam"
                                       value="{{ old('warna_tanda') }}"
                                       required>
                                @error('warna_tanda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        {{-- KOLOM KANAN --}}
                        <div class="col-md-6">

                            {{-- Jenis Kelamin --}}
                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin <span class="text-danger">*</span></label>
                                <div class="d-flex gap-4">

                                    <div class="form-check">
                                        <input type="radio"
                                               name="jenis_kelamin"
                                               value="J"
                                               id="jantan"
                                               class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                               {{ old('jenis_kelamin') == 'J' ? 'checked' : '' }}
                                               required>
                                        <label for="jantan" class="form-check-label">
                                            <i class="bi bi-gender-male text-primary"></i> Jantan
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <input type="radio"
                                               name="jenis_kelamin"
                                               value="B"
                                               id="betina"
                                               class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                               {{ old('jenis_kelamin') == 'B' ? 'checked' : '' }}
                                               required>
                                        <label for="betina" class="form-check-label">
                                            <i class="bi bi-gender-female text-danger"></i> Betina
                                        </label>
                                    </div>

                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-3">
                                <label for="idpemilik" class="form-label">Pemilik <span class="text-danger">*</span></label>
                                <select id="idpemilik"
                                        name="idpemilik"
                                        class="form-select @error('idpemilik') is-invalid @enderror"
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ras Hewan --}}
                            <div class="mb-3">
                                <label for="idras_hewan" class="form-label">Ras Hewan <span class="text-danger">*</span></label>
                                <select id="idras_hewan"
                                        name="idras_hewan"
                                        class="form-select @error('idras_hewan') is-invalid @enderror"
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan Data
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
