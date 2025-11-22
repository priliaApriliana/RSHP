@extends('layouts.lte.main')

@section('page-title', 'Daftar Temu Dokter')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Form Daftar Temu Dokter</h3>
    </div>

    <div class="card-body">

        <form action="{{ route('resepsionis.temudokter.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Nama Hewan</label>
                <select name="idpet" class="form-control" required>
                    @foreach ($pet as $p)
                        <option value="{{ $p->idpet }}">
                            {{ $p->nama }} - Pemilik: {{ $p->pemilik->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Pilih Dokter</label>
                <select name="idrole_user" class="form-control" required>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->idrole_user }}">
                            dr. {{ $d->user->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">
                <i class="fas fa-save"></i> Daftarkan
            </button>

        </form>

    </div>
</div>

@endsection
