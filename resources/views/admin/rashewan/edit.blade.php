@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.rashewan.index') }}">Ras Hewan</a></li>
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
                    Edit Ras Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.rashewan.update', $ras->idras_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">
                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Terjadi Kesalahan
                            </div>
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Ras --}}
                    <div class="input-group-wrapper">
                        <label for="nama_ras" class="form-label-custom">
                            Nama Ras Hewan
                            <span class="required-star">*</span>
                        </label>

                        <input type="text"
                               id="nama_ras"
                               name="nama_ras"
                               class="form-input-custom @error('nama_ras') is-invalid @enderror"
                               placeholder="Contoh: Persia, Golden Retriever"
                               value="{{ old('nama_ras', $ras->nama_ras) }}"
                               required>

                        @error('nama_ras')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Perbarui nama ras hewan yang spesifik
                            </div>
                        @enderror
                    </div>

                    {{-- Pilih Jenis Hewan --}}
                    <div class="input-group-wrapper">
                        <label for="idjenis_hewan" class="form-label-custom">
                            Jenis Hewan
                            <span class="required-star">*</span>
                        </label>

                        <select name="idjenis_hewan"
                                id="idjenis_hewan"
                                class="form-select-custom @error('idjenis_hewan') is-invalid @enderror"
                                required>

                            <option value="" disabled>-- Pilih Jenis Hewan --</option>

                            @foreach ($jenisHewan as $j)
                                <option value="{{ $j->idjenis_hewan }}"
                                    {{ old('idjenis_hewan', $ras->idjenis_hewan) == $j->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $j->nama_jenis_hewan }}
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