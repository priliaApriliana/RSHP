@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Tambah</li>
@endsection

@section('content')

<style>
:root{
    --blue-dark:#395886;
    --blue-main:#628ECB;
    --blue-soft:#D5DEEF;
    --blue-bg:#F0F3FA;
}

/* WRAPPER */
.form-wrapper{
    max-width: 900px;
    margin: auto;
}

/* CARD */
.form-card{
    background: #fff;
    border-radius: 16px;
    border: 1px solid var(--blue-soft);
    box-shadow: 0 6px 16px rgba(57,88,134,.15);
    overflow: hidden;
}

/* HEADER */
.form-header{
    background: linear-gradient(135deg,var(--blue-main),var(--blue-dark));
    padding: 20px 28px;
}
.form-header h3{
    margin: 0;
    color: #fff;
    font-weight: 700;
    font-size: 18px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* BODY */
.form-body{
    padding: 28px;
    background: var(--blue-bg);
}

/* AUTO CODE */
.auto-code{
    background: linear-gradient(135deg,#e8f1ff,#d5deef);
    border: 2px dashed var(--blue-main);
    border-radius: 14px;
    padding: 20px;
    margin-bottom: 24px;
    text-align: center;
}
.auto-code small{
    display: block;
    font-weight: 600;
    color: var(--blue-dark);
    margin-bottom: 8px;
}
.auto-code h2{
    margin: 0;
    font-family: monospace;
    letter-spacing: 4px;
    color: var(--blue-dark);
}

/* FORM */
.form-label{
    font-weight: 600;
    color: var(--blue-dark);
}
.form-control,
.form-select{
    border-radius: 10px;
}
.form-control:focus,
.form-select:focus{
    border-color: var(--blue-main);
    box-shadow: 0 0 0 .2rem rgba(98,142,203,.25);
}

/* ERROR */
.alert-error{
    background: #fff;
    border-left: 5px solid #e74c3c;
    border-radius: 10px;
    padding: 16px 20px;
    margin-bottom: 20px;
}
.alert-error h6{
    color:#e74c3c;
    font-weight:700;
}

/* FOOTER */
.form-footer{
    background: #fff;
    border-top: 1px solid var(--blue-soft);
    padding: 18px 28px;
    display: flex;
    justify-content: space-between;
}

/* BUTTON */
.btn-primary{
    background: linear-gradient(135deg,var(--blue-main),var(--blue-dark));
    border: none;
    font-weight: 600;
}
.btn-secondary{
    border: 2px solid var(--blue-main);
    background: #fff;
    color: var(--blue-main);
    font-weight: 600;
}
</style>

<div class="container-fluid">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h3>
                    <i class="bi bi-plus-circle-fill"></i>
                    Tambah Kode Tindakan Terapi
                </h3>
            </div>

            <form action="{{ route('admin.kodetindakanterapi.store') }}" method="POST">
            @csrf

            <div class="form-body">

                {{-- ERROR --}}
                @if ($errors->any())
                <div class="alert-error">
                    <h6><i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan</h6>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                {{-- AUTO CODE --}}
                <div class="auto-code">
                    <small>Kode Otomatis (digenerate sistem)</small>
                    <h2>{{ $nextCode }}</h2>
                </div>

                {{-- DESKRIPSI --}}
                <div class="mb-3">
                    <label class="form-label">Nama Tindakan Terapi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi_tindakan_terapi"
                              class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                              rows="4"
                              required>{{ old('deskripsi_tindakan_terapi') }}</textarea>
                    @error('deskripsi_tindakan_terapi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori <span class="text-danger">*</span></label>
                    <select name="idkategori"
                            class="form-select @error('idkategori') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($kategori as $k)
                            <option value="{{ $k->idkategori }}"
                                {{ old('idkategori') == $k->idkategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KATEGORI KLINIS --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Klinis <span class="text-danger">*</span></label>
                    <select name="idkategori_klinis"
                            class="form-select @error('idkategori_klinis') is-invalid @enderror"
                            required>
                        <option value="">-- Pilih Kategori Klinis --</option>
                        @foreach($kategoriKlinis as $kk)
                            <option value="{{ $kk->idkategori_klinis }}"
                                {{ old('idkategori_klinis') == $kk->idkategori_klinis ? 'selected' : '' }}>
                                {{ $kk->nama_kategori_klinis }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            {{-- FOOTER --}}
            <div class="form-footer">
                <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Simpan
                </button>
            </div>

            </form>

        </div>
    </div>
</div>

@endsection
