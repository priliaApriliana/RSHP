@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold text-primary">Form Pendaftaran Temu Dokter</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('resepsionis.temudokter.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="idpet" class="form-label">Pilih Pet</label>
                <select name="idpet" id="idpet" class="form-control" required>
                    <option value="">-- Pilih Pet --</option>
                    @foreach ($pet as $p)
                        <option value="{{ $p->idpet }}">
                            {{ $p->nama }} ({{ $p->pemilik->user->nama ?? 'Tanpa Pemilik' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="idrole_user" class="form-label">Pilih Dokter</label>
                <select name="idrole_user" id="idrole_user" class="form-control" required>
                    <option value="">-- Pilih Dokter --</option>
                    @foreach ($dokter as $d)
                        <option value="{{ $d->idrole_user }}">{{ $d->user->nama }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Daftarkan</button>
        </form>
    </div>
</div>
@endsection
