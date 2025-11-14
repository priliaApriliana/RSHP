@extends('layouts.lte.main')

@section('page-title', 'Tambah Role Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Daftar Role</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Role Baru
                </h3>
            </div>

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Error Alert --}}
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

                    {{-- Input Nama Role --}}
                    <div class="mb-3">
                        <label for="nama_role" class="form-label">
                            Nama Role <span class="text-danger">*</span>
                        </label>

                        <input type="text" 
                               class="form-control @error('nama_role') is-invalid @enderror" 
                               id="nama_role" 
                               name="nama_role" 
                               value="{{ old('nama_role') }}"
                               placeholder="Masukkan nama role..."
                               required>

                        @error('nama_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Simpan
                        </button>
                    </div>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
