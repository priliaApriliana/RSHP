@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jenishewan.index') }}">Jenis Hewan</a></li>
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
                    Edit Jenis Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.jenishewan.update', $data->idjenis_hewan) }}" method="POST">
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

                    {{-- Input Group --}}
                    <div class="input-group-wrapper">
                        <label for="nama_jenis_hewan" class="form-label-custom">
                            Nama Jenis Hewan
                            <span class="required-star">*</span>
                        </label>

                        <input type="text"
                               id="nama_jenis_hewan"
                               name="nama_jenis_hewan"
                               class="form-input-custom @error('nama_jenis_hewan') is-invalid @enderror"
                               placeholder="Contoh: Anjing (Canis lupus familiaris)"
                               value="{{ old('nama_jenis_hewan', $data->nama_jenis_hewan) }}"
                               required>

                        @error('nama_jenis_hewan')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @else
                            <div class="helper-text">
                                <i class="bi bi-info-circle-fill"></i>
                                Masukkan nama lengkap jenis hewan beserta nama ilmiahnya
                            </div>
                        @enderror
                    </div>
                </div>

                {{-- Footer --}}
                <div class="form-footer">
                    <a href="{{ route('admin.jenishewan.index') }}" class="btn-custom btn-back-custom">
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