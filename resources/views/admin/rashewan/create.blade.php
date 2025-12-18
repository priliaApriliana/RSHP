@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.rashewan.index') }}">Ras Hewan</a></li>
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
                    Tambah Ras Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.rashewan.store') }}" method="POST">
                @csrf

                <div class="form-body">
                    {{-- Error Notif --}}
                    @if (session('error'))
                        <div class="alert-error">
                            <p class="alert-error-text">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                {{ session('error') }}
                            </p>
                        </div>
                    @endif

                    {{-- Input Nama Ras --}}
                    <div class="input-group-wrapper">
                        <label for="nama_ras" class="form-label-custom">
                            Nama Ras Hewan
                            <span class="required-star">*</span>
                        </label>

                        <input 
                            type="text"
                            id="nama_ras"
                            name="nama_ras"
                            class="form-input-custom @error('nama_ras') is-invalid @enderror"
                            placeholder="Contoh: Golden Retriever, Persia, Maine Coon"
                            value="{{ old('nama_ras') }}"
                            required
                        >

                        @error('nama_ras')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama ras hewan yang spesifik
                            </div>
                        @enderror
                    </div>

                    {{-- Pilih Jenis Hewan --}}
                    <div class="input-group-wrapper">
                        <label for="idjenis_hewan" class="form-label-custom">
                            Jenis Hewan
                            <span class="required-star">*</span>
                        </label>

                        <select 
                            id="idjenis_hewan"
                            name="idjenis_hewan"
                            class="form-select-custom @error('idjenis_hewan') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenisHewan as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}"
                                    {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}
                                >
                                    {{ $jenis->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>

                        @error('idjenis_hewan')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Pilih kategori jenis hewan yang sesuai
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.rashewan.index') }}" class="btn-custom btn-back-custom">
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