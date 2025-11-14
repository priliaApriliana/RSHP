@extends('layouts.lte.main')

@section('page-title', 'Tambah Ras Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.rashewan.index') }}">Ras Hewan</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-plus-circle"></i> Tambah Ras Hewan
                </h3>
            </div>

            <form action="{{ route('admin.rashewan.store') }}" method="POST">
                @csrf

                <div class="card-body">
                    
                    {{-- Notifikasi Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Input Nama Ras Hewan --}}
                    <div class="mb-3">
                        <label for="nama_ras" class="form-label">
                            Nama Ras Hewan <span class="text-danger">*</span>
                        </label>
                        <input 
                            type="text"
                            id="nama_ras"
                            name="nama_ras"
                            class="form-control @error('nama_ras') is-invalid @enderror"
                            placeholder="Contoh: Golden Retriever, Persia, Maine Coon"
                            value="{{ old('nama_ras') }}"
                            required
                        >
                        @error('nama_ras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pilih Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="idjenis_hewan" class="form-label">
                            Jenis Hewan <span class="text-danger">*</span>
                        </label>

                        <select 
                            id="idjenis_hewan"
                            name="idjenis_hewan"
                            class="form-select @error('idjenis_hewan') is-invalid @enderror"
                            required
                        >
                            <option value="">-- Pilih Jenis Hewan --</option>
                            @foreach ($jenisHewan as $jenis)
                                <option value="{{ $jenis->idjenis_hewan }}"
                                    {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}
                                >
                                    {{ $jenis->nama_jenis_hewan }}
                                </option>
                            @endforeach
                        </select>

                        @error('idjenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- Footer Card --}}
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.rashewan.index') }}" class="btn btn-secondary">
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
