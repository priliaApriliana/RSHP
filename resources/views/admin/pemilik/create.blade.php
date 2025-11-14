@extends('layouts.lte.main')

@section('page-title', 'Tambah Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-person-plus-fill"></i> Tambah Pemilik
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.pemilik.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Notifikasi Error --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nomor WhatsApp --}}
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">Nomor WhatsApp <span class="text-danger">*</span></label>

                        <input type="text"
                               id="no_wa"
                               name="no_wa"
                               class="form-control @error('no_wa') is-invalid @enderror"
                               placeholder="Contoh: 08123456789 atau +628123456789"
                               value="{{ old('no_wa') }}"
                               required>

                        @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                        
                        <textarea id="alamat"
                                  name="alamat"
                                  rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  placeholder="Masukkan alamat lengkap"
                                  required>{{ old('alamat') }}</textarea>

                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pilih User --}}
                    <div class="mb-3">
                        <label for="iduser" class="form-label">Pilih User <span class="text-danger">*</span></label>

                        <select id="iduser"
                                name="iduser"
                                class="form-select @error('iduser') is-invalid @enderror"
                                required>
                            <option value="">-- Pilih User --</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->iduser }}"
                                    {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                    {{ $user->nama }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>

                        @error('iduser')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- CARD FOOTER --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
