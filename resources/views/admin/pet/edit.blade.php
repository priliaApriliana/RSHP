@extends('layouts.lte.main')

@section('page-title', 'Edit Data Pet')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pet.index') }}">Data Pet</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-10 offset-md-1">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Data Pet
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.pet.update', $pet->idpet) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    <div class="row">

                        {{-- KIRI --}}
                        <div class="col-md-6">

                            {{-- Nama Pet --}}
                            <div class="mb-3">
                                <label for="nama" class="form-label">
                                    Nama Pet <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="nama"
                                       name="nama"
                                       class="form-control @error('nama') is-invalid @enderror"
                                       value="{{ old('nama', $pet->nama) }}"
                                       placeholder="Contoh: Brownie"
                                       required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div class="mb-3">
                                <label for="tanggal_lahir" class="form-label">
                                    Tanggal Lahir <span class="text-danger">*</span>
                                </label>
                                <input type="date"
                                       id="tanggal_lahir"
                                       max="{{ date('Y-m-d') }}"
                                       name="tanggal_lahir"
                                       class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                       value="{{ old('tanggal_lahir', $pet->tanggal_lahir) }}"
                                       required>
                                @error('tanggal_lahir')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Warna/Tanda --}}
                            <div class="mb-3">
                                <label for="warna_tanda" class="form-label">
                                    Warna / Tanda Khusus <span class="text-danger">*</span>
                                </label>
                                <input type="text"
                                       id="warna_tanda"
                                       name="warna_tanda"
                                       class="form-control @error('warna_tanda') is-invalid @enderror"
                                       value="{{ old('warna_tanda', $pet->warna_tanda) }}"
                                       placeholder="Contoh: Putih coklat"
                                       required>
                                @error('warna_tanda')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>


                        {{-- KANAN --}}
                        <div class="col-md-6">

                            {{-- Jenis Kelamin --}}
                            <div class="mb-3">
                                <label class="form-label">
                                    Jenis Kelamin <span class="text-danger">*</span>
                                </label>
                                <div class="d-flex gap-4">
                                    <label class="form-check-label">
                                        <input type="radio" name="jenis_kelamin" value="J"
                                            class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'J' ? 'checked' : '' }}>
                                        <i class="bi bi-gender-male text-primary"></i> Jantan
                                    </label>

                                    <label class="form-check-label">
                                        <input type="radio" name="jenis_kelamin" value="B"
                                            class="form-check-input @error('jenis_kelamin') is-invalid @enderror"
                                            {{ old('jenis_kelamin', $pet->jenis_kelamin) == 'B' ? 'checked' : '' }}>
                                        <i class="bi bi-gender-female text-danger"></i> Betina
                                    </label>
                                </div>
                                @error('jenis_kelamin')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Pemilik --}}
                            <div class="mb-3">
                                <label for="idpemilik" class="form-label">
                                    Pemilik <span class="text-danger">*</span>
                                </label>
                                <select name="idpemilik"
                                        id="idpemilik"
                                        class="form-select @error('idpemilik') is-invalid @enderror"
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Ras Hewan --}}
                            <div class="mb-3">
                                <label for="idras_hewan" class="form-label">
                                    Ras Hewan <span class="text-danger">*</span>
                                </label>
                                <select name="idras_hewan"
                                        id="idras_hewan"
                                        class="form-select @error('idras_hewan') is-invalid @enderror"
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
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                    </div> {{-- end row --}}

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
