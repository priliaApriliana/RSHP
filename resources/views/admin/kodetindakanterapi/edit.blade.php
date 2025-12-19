@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Kode Tindakan Terapi
                </h3>
            </div>

            <form action="{{ route('admin.kodetindakanterapi.update', $kode->idkode_tindakan_terapi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">

                    {{-- ERROR --}}
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

                    {{-- LOCKED CODE --}}
                    <div class="locked-code-display">
                        <div class="locked-code-label">
                            <i class="bi bi-lock-fill"></i>
                            Kode Tindakan (Tidak dapat diubah)
                        </div>
                        <div class="locked-code-value">{{ $kode->kode }}</div>
                        <div class="locked-code-info">
                            <i class="bi bi-info-circle"></i>
                            Kode bersifat permanen dan tidak dapat diubah
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            Nama Tindakan Terapi
                            <span class="required-star">*</span>
                        </label>

                        <textarea name="deskripsi_tindakan_terapi"
                                  rows="3"
                                  class="form-textarea-custom @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                                  placeholder="Tuliskan deskripsi tindakan..."
                                  required>{{ old('deskripsi_tindakan_terapi', $kode->deskripsi_tindakan_terapi) }}</textarea>

                        @error('deskripsi_tindakan_terapi')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            Kategori
                            <span class="required-star">*</span>
                        </label>

                        <select name="idkategori"
                                class="form-input-custom @error('idkategori') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih Kategori --</option>
                            @foreach ($kategori as $k)
                                <option value="{{ $k->idkategori }}"
                                    {{ old('idkategori', $kode->idkategori) == $k->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- KATEGORI KLINIS --}}
                    <div class="input-group-wrapper">
                        <label class="form-label-custom">
                            Kategori Klinis
                            <span class="required-star">*</span>
                        </label>

                        <select name="idkategori_klinis"
                                class="form-input-custom @error('idkategori_klinis') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih Kategori Klinis --</option>
                            @foreach ($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}"
                                    {{ old('idkategori_klinis', $kode->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori_klinis')
                            <div class="error-message">
                                <i class="bi bi-x-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('admin.kodetindakanterapi.index') }}"
                       class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Update Data
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection