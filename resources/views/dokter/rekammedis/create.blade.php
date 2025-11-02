@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-plus-circle"></i> Tambah Rekam Medis
        </h3>

        <form action="{{ route('dokter.rekammedis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="idreservasi_dokter" class="form-label">Pilih Reservasi Dokter</label>
                <select name="idreservasi_dokter" class="form-select" required>
                    <option value="">-- Pilih Hewan & Pemilik --</option>
                    @foreach ($temuDokter as $t)
                        <option value="{{ $t->idreservasi_dokter }}">
                            {{ $t->pet->nama }} - {{ $t->pet->pemilik->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="anamnesa" class="form-label">Anamnesa</label>
                <textarea name="anamnesa" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="temuan_klinis" class="form-label">Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="diagnosa" class="form-label">Diagnosa</label>
                <textarea name="diagnosa" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Simpan
            </button>
            <a href="{{ route('dokter.rekammedis.index') }}" class="btn btn-secondary">
                Batal
            </a>
        </form>
    </div>
</div>
@endsection
