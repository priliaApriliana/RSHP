@extends('layouts.lte.main')

@section('page-title', 'Form Registrasi Pemilik Hewan')

@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Berhasil!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="main-content" id="mainContent">
    <div class="container mt-4">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <form action="{{ route('resepsionis.pemilik.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Pemilik</label>
                <input type="text" name="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nomor WhatsApp</label>
                <input type="text" name="no_wa" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="2" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Simpan Data Pemilik</button>
        </form>
    </div>
</div>
@endsection
