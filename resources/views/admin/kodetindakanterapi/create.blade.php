@extends('layouts.lte.main')

@section('page-title', 'Tambah Kode Tindakan Terapi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Kode Tindakan Terapi
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- ERROR ALERT --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- KODE --}}
                    <div class="mb-3">
                        <label class="form-label">Kode <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('kode') is-invalid @enderror" 
                               name="kode" 
                               maxlength="5"
                               placeholder="Contoh: K001"
                               value="{{ old('kode') }}"
                               required>

                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                        <textarea name="deskripsi_tindakan_terapi" 
                                  class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Masukkan deskripsi tindakan..."
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

                        @error('idkategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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

                        @error('idkategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
