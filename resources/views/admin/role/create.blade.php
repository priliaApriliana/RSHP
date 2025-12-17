@extends('layouts.lte.main')

@section('page-title', 'Tambah Role Baru')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Daftar Role</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<style>
/* ===== CARD UTAMA ===== */
.form-card {
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 4px 14px rgba(57, 88, 134, 0.12);
    overflow: hidden;
}

/* ===== HEADER CARD ===== */
.form-header {
    background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
    padding: 1.25rem 1.75rem;
    color: #fff;
    display: flex;
    align-items: center;
    gap: 0.6rem;
}

.form-header h4 {
    margin: 0;
    font-size: 1.05rem;
    font-weight: 700;
}

/* ===== BODY ===== */
.form-body {
    padding: 2rem;
}

/* ===== FORM ===== */
.form-group {
    max-width: 520px;
    margin-bottom: 1.5rem;
}

.form-label {
    font-weight: 600;
    font-size: 0.85rem;
    color: #395886;
    margin-bottom: 0.4rem;
}

.form-control-custom {
    width: 100%;
    padding: 0.75rem 0.9rem;
    border-radius: 12px;
    border: 2px solid #D5DEEF;
    font-size: 0.85rem;
    transition: 0.3s;
}

.form-control-custom:focus {
    border-color: #8AAEE0;
    box-shadow: 0 0 0 4px rgba(138,174,224,0.12);
    outline: none;
}

.form-control-custom.is-invalid {
    border-color: #d63031;
}

.invalid-feedback {
    font-size: 0.75rem;
    font-weight: 600;
}

/* ===== ALERT ===== */
.alert-danger {
    background: #fff5f5;
    color: #c53030;
    border-left: 4px solid #d63031;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.75rem;
    font-size: 0.8rem;
}

/* ===== FOOTER ===== */
.form-footer {
    background: #F5F8FD;
    padding: 1.25rem 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #D5DEEF;
}

/* ===== BUTTON ===== */
.btn-custom {
    padding: 0.7rem 1.8rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    border: none;
    cursor: pointer;
    transition: 0.3s;
    text-decoration: none;
}

.btn-primary-custom {
    background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
    color: #fff;
    box-shadow: 0 3px 10px rgba(98,142,203,0.35);
}

.btn-primary-custom:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 14px rgba(98,142,203,0.45);
}

.btn-secondary-custom {
    background: #E8EDF5;
    color: #395886;
}

.btn-secondary-custom:hover {
    background: #D5DEEF;
    transform: translateY(-2px);
}
</style>

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
