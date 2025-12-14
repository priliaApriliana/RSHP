@extends('layouts.lte.main')

@section('page-title', 'Edit Kategori Klinis')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategoriklinis.index') }}">Kategori Klinis</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Kategori Klinis
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kategoriklinis.update', $data->idkategori_klinis) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif


                    {{-- Nama Kategori Klinis --}}
                    <div class="mb-3">
                        <label for="nama_kategori_klinis" class="form-label">
                            Nama Kategori Klinis <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="nama_kategori_klinis"
                               name="nama_kategori_klinis"
                               class="form-control @error('nama_kategori_klinis') is-invalid @enderror"
                               placeholder="Contoh: Umum, Bedah, Gigi"
                               value="{{ old('nama_kategori_klinis', $data->nama_kategori_klinis) }}"
                               required>

                        @error('nama_kategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div> {{-- END CARD BODY --}}

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kategoriklinis.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
