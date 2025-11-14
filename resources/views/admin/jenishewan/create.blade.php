@extends('layouts.lte.main')

@section('page-title', 'Tambah Jenis Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jenishewan.index') }}">Jenis Hewan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">
            
            {{-- Header --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Jenis Hewan
                </h3>
            </div>

            {{-- Form --}}
            <form action="{{ route('admin.jenishewan.store') }}" method="POST">
                @csrf

                <div class="card-body">

                    {{-- Error Notif --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Input --}}
                    <div class="mb-3">
                        <label for="nama_jenis_hewan" class="form-label">
                            Nama Jenis Hewan <span class="text-danger">*</span>
                        </label>

                        <input 
                            type="text"
                            name="nama_jenis_hewan"
                            id="nama_jenis_hewan"
                            class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                            placeholder="Masukkan nama jenis hewan"
                            value="{{ old('nama_jenis_hewan') }}"
                            required
                        >

                        @error('nama_jenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.jenishewan.index') }}" class="btn btn-secondary">
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
