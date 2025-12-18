@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h3>
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Kode Tindakan Terapi
                </h3>
            </div>

            <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- ERROR --}}
                @if ($errors->any())
                <div class="alert-error">
                    <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- AUTO CODE --}}
                <div class="auto-code">
                    <small>Kode Otomatis (digenerate sistem)</small>
                    <h2>{{ $nextCode }}</h2>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Nama Tindakan Terapi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi_tindakan_terapi"
                              class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                              rows="4"
                              required>{{ old('deskripsi_tindakan_terapi') }}</textarea>
                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="idkategori"
                            class="form-select @error('idkategori') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->idkategori }}"
                                {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KATEGORI KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                    <select name="idkategori_klinis"
                            class="form-select @error('idkategori_klinis') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kategori Klinis --</option>
                        @foreach($kategoriKlinis as $kk)
                            <option value="{{ $kk->idkategori_klinis }}"
                                {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                {{ $kk->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="form-footer">
                <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>

            </form>

        </div>
    </div>
</div>

@endsection
