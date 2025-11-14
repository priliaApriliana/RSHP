@extends('layouts.lte.main')

@section('page-title', 'Tambah Kategori Klinis')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategoriklinis.index') }}">Kategori Klinis</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row justify-content-center">
    <div class="col-md-6">

        <div class="card">

            {{-- CARD HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Kategori Klinis
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kategoriklinis.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- ERROR ALERT --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terdapat kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- INPUT NAMA --}}
                    <div class="mb-3">
                        <label for="nama_kategori_klinis" class="form-label">
                            Nama Kategori Klinis <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                               id="nama_kategori_klinis"
                               name="nama_kategori_klinis"
                               placeholder="Contoh: Umum, Bedah, Gawat Darurat"
                               value="{{ old('nama_kategori_klinis') }}"
                               required>
                        @error('nama_kategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kategoriklinis.index') }}" class="btn btn-secondary">
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
