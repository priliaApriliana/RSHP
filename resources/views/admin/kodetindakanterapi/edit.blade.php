@extends('layouts.lte.main')

@section('page-title', 'Edit Kode Tindakan Terapi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<style>
    .locked-code-display {
        background: linear-gradient(135deg, #F0F3FA 0%, #E8F4F8 100%);
        border: 2px solid #8AAEE0;
        border-radius: 10px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
    }

    .locked-code-label {
        font-size: 0.8125rem;
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .locked-code-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #395886;
        font-family: 'Courier New', monospace;
        letter-spacing: 2px;
    }

    .locked-code-info {
        font-size: 0.75rem;
        color: #628ECB;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }
</style>

<div class="row">
    <div class="col-md-10 offset-md-1">

        <div class="card">
            
            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Kode Tindakan Terapi
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.kodetindakanterapi.update', $kode->idkode_tindakan_terapi) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error Notification --}}
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

                    {{-- LOCKED CODE DISPLAY --}}
                    <div class="locked-code-display">
                        <div class="locked-code-label">
                            <i class="bi bi-lock-fill"></i>
                            Kode Tindakan (Tidak dapat diubah)
                        </div>
                        <div class="locked-code-value">{{ $kode->kode }}</div>
                        <div class="locked-code-info">
                            <i class="bi bi-info-circle"></i>
                            Kode bersifat permanen dan tidak dapat diubah setelah dibuat
                        </div>
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label for="deskripsi_tindakan_terapi" class="form-label">
                            Nama Tindakan Terapi <span class="text-danger">*</span>
                        </label>

                        <textarea name="deskripsi_tindakan_terapi"
                                  id="deskripsi_tindakan_terapi"
                                  rows="3"
                                  class="form-control @error('deskripsi_tindakan_terapi') is-invalid @enderror"
                                  placeholder="Tuliskan deskripsi tindakan..."
                                  required>{{ old('deskripsi_tindakan_terapi', $kode->deskripsi_tindakan_terapi) }}</textarea>

                        @error('deskripsi_tindakan_terapi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI --}}
                    <div class="mb-3">
                        <label for="idkategori" class="form-label">
                            Kategori <span class="text-danger">*</span>
                        </label>

                        <select name="idkategori"
                                id="idkategori"
                                class="form-select @error('idkategori') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih Kategori --</option>

                            @foreach ($kategori as $k)
                                <option value="{{ $k->idkategori }}"
                                    {{ old('idkategori', $kode->idkategori) == $k->idkategori ? 'selected' : '' }}>
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- KATEGORI KLINIS --}}
                    <div class="mb-3">
                        <label for="idkategori_klinis" class="form-label">
                            Kategori Klinis <span class="text-danger">*</span>
                        </label>

                        <select name="idkategori_klinis"
                                id="idkategori_klinis"
                                class="form-select @error('idkategori_klinis') is-invalid @enderror"
                                required>
                            <option value="" disabled>-- Pilih Kategori Klinis --</option>

                            @foreach ($kategoriKlinis as $kk)
                                <option value="{{ $kk->idkategori_klinis }}"
                                    {{ old('idkategori_klinis', $kode->idkategori_klinis) == $kk->idkategori_klinis ? 'selected' : '' }}>
                                    {{ $kk->nama_kategori_klinis }}
                                </option>
                            @endforeach
                        </select>

                        @error('idkategori_klinis')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>


                </div> {{-- END CARD BODY --}}

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.kodetindakanterapi.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update Data
                    </button>
                </div>

            </form>

        </div>

    </div>
</div>

@endsection