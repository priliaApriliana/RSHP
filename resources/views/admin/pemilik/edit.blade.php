@extends('layouts.lte.main')

@section('page-title', 'Edit Data Pemilik')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.pemilik.index') }}">Data Pemilik</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Data Pemilik
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.pemilik.update', $pemilik->idpemilik) }}" method="POST">
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



                    {{-- Nomor WhatsApp --}}
                    <div class="mb-3">
                        <label for="no_wa" class="form-label">
                            Nomor WhatsApp <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="no_wa"
                               name="no_wa"
                               class="form-control @error('no_wa') is-invalid @enderror"
                               value="{{ old('no_wa', $pemilik->no_wa) }}"
                               placeholder="Contoh: 08123456789"
                               required>
                        @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-3">
                        <label for="alamat" class="form-label">
                            Alamat <span class="text-danger">*</span>
                        </label>
                        <textarea name="alamat"
                                  id="alamat"
                                  rows="3"
                                  class="form-control @error('alamat') is-invalid @enderror"
                                  required>{{ old('alamat', $pemilik->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pilih User --}}
                    <div class="mb-3">
                        <label for="iduser" class="form-label">
                            Pilih User <span class="text-danger">*</span>
                        </label>

                        <select name="iduser"
                                id="iduser"
                                class="form-select @error('iduser') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih User --</option>

                            @foreach ($users as $user)
                                <option value="{{ $user->iduser }}"
                                    {{ old('iduser', $pemilik->iduser) == $user->iduser ? 'selected' : '' }}>
                                    {{ $user->nama }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>

                        @error('iduser')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div> {{-- card-body --}}

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
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
