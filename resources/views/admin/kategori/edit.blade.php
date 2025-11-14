@extends('layouts.lte.main')

@section('page-title', 'Edit Kategori')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            <!-- HEADER -->
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Kategori
                </h3>
            </div>

            <!-- FORM -->
            <form action="{{ route('admin.kategori.update', $kategori->idkategori) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error Validation --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Terjadi kesalahan:</strong>
                            <ul class="mt-2 mb-0">
                                @foreach($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Kategori --}}
                    <div class="mb-3">
                        <label for="nama_kategori" class="form-label">
                            Nama Kategori <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="nama_kategori"
                               name="nama_kategori"
                               class="form-control @error('nama_kategori') is-invalid @enderror"
                               placeholder="Contoh: Obat, Vaksinasi, Grooming"
                               value="{{ old('nama_kategori', $kategori->nama_kategori) }}"
                               required>

                        @error('nama_kategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi (opsional) --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">
                            Deskripsi <small class="text-muted">(opsional)</small>
                        </label>

                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  rows="3"
                                  placeholder="Tulis keterangan tambahan jika diperlukan...">{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div> <!-- END CARD BODY -->

                <!-- FOOTER -->
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
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
