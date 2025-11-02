@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">Form Tambah Rekam Medis</h3>

        <form action="{{ route('perawat.rekammedis.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="idreservasi_dokter" class="form-label">Pilih Pasien (Temu Dokter)</label>
                <select name="idreservasi_dokter" class="form-select" required>
                    <option value="">-- Pilih Pasien --</option>
                    @foreach ($temuDokter as $t)
                        <option value="{{ $t->idreservasi_dokter }}">
                            {{ $t->pet->nama }} - {{ $t->pet->pemilik->user->nama ?? '-' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Anamnesa</label>
                <textarea name="anamnesa" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Temuan Klinis</label>
                <textarea name="temuan_klinis" class="form-control" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Diagnosa</label>
                <textarea name="diagnosa" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
