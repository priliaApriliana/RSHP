@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Daftar Role</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/create.css') }}">
@endsection

@section('content')

<div class="container-fluid px-4 d-flex justify-content-center">
    <div style="width:100%; max-width: 900px;">

        {{-- CARD --}}
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <i class="bi bi-plus-circle"></i>
                <h4>Tambah Role Baru</h4>
            </div>

            <form action="{{ route('admin.role.store') }}" method="POST">
                @csrf

                <div class="form-body">

                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong><i class="bi bi-exclamation-triangle-fill me-2"></i>Terdapat kesalahan:</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- NAMA ROLE --}}
                    <div class="form-group">
                        <label class="form-label">
                            Nama Role <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               name="nama_role"
                               value="{{ old('nama_role') }}"
                               class="form-control-custom @error('nama_role') is-invalid @enderror"
                               placeholder="Masukkan nama role"
                               required>
                        @error('nama_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('admin.role.index') }}" class="btn-custom btn-secondary-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn-custom btn-primary-custom">
                        <i class="bi bi-save"></i> Simpan
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection
