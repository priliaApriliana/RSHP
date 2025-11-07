@extends('layouts.app')
@section('title', 'Tambah Ras Hewan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Ras Hewan</h4>
                </div>

                <div class="card-body">
                    {{-- Notifikasi Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form Tambah Ras Hewan --}}
                    <form action="{{ route('admin.rashewan.store') }}" method="POST">
                        @csrf

                        {{-- Nama Ras Hewan --}}
                        <div class="mb-3">
                            <label for="nama_ras" class="form-label">
                                Nama Ras Hewan <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('nama_ras') is-invalid @enderror" 
                                id="nama_ras"
                                name="nama_ras"
                                value="{{ old('nama_ras') }}"
                                placeholder="Contoh: Golden Retriever, Persia, Maine Coon"
                                required
                            >
                            @error('nama_ras')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilih Jenis Hewan --}}
                        <div class="mb-3">
                            <label for="idjenis_hewan" class="form-label">
                                Jenis Hewan <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('idjenis_hewan') is-invalid @enderror"
                                id="idjenis_hewan"
                                name="idjenis_hewan"
                                required
                            >
                                <option value="">-- Pilih Jenis Hewan --</option>
                                @foreach ($jenisHewan as $jenis)
                                    <option value="{{ $jenis->idjenis_hewan }}" 
                                        {{ old('idjenis_hewan') == $jenis->idjenis_hewan ? 'selected' : '' }}>
                                        {{ $jenis->nama_jenis_hewan }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idjenis_hewan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.rashewan.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
