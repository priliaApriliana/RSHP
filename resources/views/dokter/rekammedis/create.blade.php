@extends('layouts.lte.main')

@section('page-title', 'Periksa Pasien')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Pemeriksaan Pasien</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('dokter.rekammedis.store') }}" method="POST">
            @csrf

            <input type="hidden" name="idreservasi_dokter" value="{{ $pasien->idreservasi_dokter }}">

            {{-- NAMA HEWAN --}}
            <div class="mb-3">
                <label class="form-label">Nama Hewan</label>
                <input type="text" class="form-control" value="{{ $pasien->pet->nama }}" readonly>
            </div>

            {{-- PEMILIK --}}
            <div class="mb-3">
                <label class="form-label">Pemilik</label>
                <input type="text" class="form-control" value="{{ $pasien->pet->pemilik->user->nama }}" readonly>
            </div>

            {{-- ANAMNESA --}}
            <div class="mb-3">
                <label class="form-label">Anamnesa</label>
                <textarea name="anamnesa" class="form-control @error('anamnesa') is-invalid @enderror"
                    rows="3"></textarea>
                @error('anamnesa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- TEMUAN KLINIS --}}
            <div class="mb-3">
                <label class="form-label">Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control @error('temuan_klinis') is-invalid @enderror"
                    rows="3"></textarea>
                @error('temuan_klinis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            {{-- DIAGNOSA --}}
            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosa" class="form-control @error('diagnosa') is-invalid @enderror"
                    rows="3"></textarea>
                @error('diagnosa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between mt-4">
                {{-- TOMBOL BATAL --}}
                <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left-circle"></i> Batal
                </a>

                {{-- SIMPAN --}}
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Simpan Rekam Medis
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
