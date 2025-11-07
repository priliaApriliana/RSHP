@extends('layouts.app')
@section('title', 'Tambah Pemilik')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Pemilik</h4>
                </div>

                <div class="card-body">
                    {{-- Notifikasi Error --}}
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    {{-- Form Tambah Pemilik --}}
                    <form action="{{ route('admin.pemilik.store') }}" method="POST">
                        @csrf

                        {{-- Nomor WhatsApp --}}
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">
                                Nomor WhatsApp <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control @error('no_wa') is-invalid @enderror" 
                                id="no_wa"
                                name="no_wa"
                                value="{{ old('no_wa') }}"
                                placeholder="Contoh: 08123456789 atau +628123456789"
                                required
                            >
                            @error('no_wa')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Alamat --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">
                                Alamat <span class="text-danger">*</span>
                            </label>
                            <textarea 
                                class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat"
                                name="alamat"
                                rows="3"
                                placeholder="Masukkan alamat lengkap"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Pilih User --}}
                        <div class="mb-3">
                            <label for="iduser" class="form-label">
                                Pilih User <span class="text-danger">*</span>
                            </label>
                            <select 
                                class="form-select @error('iduser') is-invalid @enderror"
                                id="iduser"
                                name="iduser"
                                required
                            >
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->iduser }}" 
                                        {{ old('iduser') == $user->iduser ? 'selected' : '' }}>
                                        {{ $user->nama }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('iduser')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi --}}
                        <div class="d-flex justify-content-between mt-4">
                            <a href="{{ route('admin.pemilik.index') }}" class="btn btn-secondary">
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
