@extends('layouts.lte.main')

@section('page-title', 'Edit Role User')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.roleuser.index') }}">Role User</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Relasi Role User
                </h3>
            </div>

            <form action="{{ route('admin.roleuser.update', $roleUser->idrole_user) }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="card-body">
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" 
                               class="form-control @error('nama') is-invalid @enderror" 
                               id="nama" 
                               name="nama" 
                               placeholder="Masukkan nama pengguna..."
                               value="{{ old('nama', $roleUser->nama_user) }}"
                               required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               placeholder="contoh@mail.com"
                               value="{{ old('email', $roleUser->email_user) }}"
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password (Optional for Edit) -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin mengubah)</small></label>
                        <input type="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               id="password" 
                               name="password" 
                               placeholder="Masukkan password baru...">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Minimal 8 karakter</small>
                    </div>

                    <!-- Konfirmasi Password -->
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" 
                               class="form-control @error('password_confirmation') is-invalid @enderror" 
                               id="password_confirmation" 
                               name="password_confirmation" 
                               placeholder="Ketik ulang password...">
                        @error('password_confirmation')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Pilih Role -->
                    <div class="mb-3">
                        <label for="idrole" class="form-label">Pilih Role <span class="text-danger">*</span></label>
                        <select class="form-select @error('idrole') is-invalid @enderror" 
                                id="idrole" 
                                name="idrole"
                                required>
                            <option value="" disabled>-- Pilih Role --</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->idrole }}" 
                                    {{ old('idrole', $roleUser->idrole) == $role->idrole ? 'selected' : '' }}>
                                    {{ $role->nama_role }}
                                </option>
                            @endforeach
                        </select>
                        @error('idrole')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                        <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" 
                                name="status"
                                required>
                            <option value="" disabled>-- Pilih Status --</option>
                            <option value="1" {{ old('status', $roleUser->status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $roleUser->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.roleuser.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection