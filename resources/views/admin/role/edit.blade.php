@extends('layouts.lte.main')

@section('page-title', 'Edit Role')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Role</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Role
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.role.update', $role->idrole) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error Notif --}}
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

                    {{-- Nama Role --}}
                    <div class="mb-3">
                        <label for="nama_role" class="form-label">
                            Nama Role <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="nama_role"
                               name="nama_role"
                               class="form-control @error('nama_role') is-invalid @enderror"
                               placeholder="Masukkan nama role"
                               value="{{ old('nama_role', $role->nama_role) }}"
                               required>

                        @error('nama_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.role.index') }}" class="btn btn-secondary">
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
