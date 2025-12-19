@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="bi bi-pencil-square"></i>
                    Edit Role
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">

                    {{-- Error Notif --}}
                    @if ($errors->any())
                        <div class="alert-error">
                            <div class="alert-error-title">
                                <i class="bi bi-exclamation-triangle-fill"></i>
                                Terjadi kesalahan
                            </div>
                            <ul>
                                @foreach ($errors->all() as $e)
                                    <li>{{ $e }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Nama Role --}}
                    <div class="mb-3">
                        <label for="nama_role" class="form-label-custom">
                            Nama Role <span class="required-star">*</span>
                        </label>
                        <input type="text"
                               id="nama_role"
                               name="nama_role"
                               class="form-input-custom @error('nama_role') is-invalid @enderror"
                               placeholder="Masukkan nama role"
                               value="{{ old('nama_role', $role->nama_role) }}"
                               required>

                        @error('nama_role')
                            <div class="error-message">
                                <i class="bi bi-exclamation-circle-fill"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('admin.role.index') }}" class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn-custom btn-update-custom">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>
        </div>

    </div>
</div>

@endsection