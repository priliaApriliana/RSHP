@extends('layouts.lte.main')

@section('page-title', 'Edit Kode Tindakan Terapi')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.kodetindakanterapi.index') }}">Kode Tindakan Terapi</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

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


                    {{-- KODE --}}
                    <div class="mb-3">
                        <label for="kode" class="form-label">
                            Kode Tindakan <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="kode"
                               name="kode"
                               maxlength="10"
                               class="form-control @error('kode') is-invalid @enderror"
                               value="{{ old('kode', $kode->kode) }}"
                               placeholder="Contoh: T001"
                               required>

                        @error('kode')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- DESKRIPSI --}}
                    <div class="mb-3">
                        <label for="deskripsi_tindakan_terapi" class="form-label">
                            Deskripsi Tindakan Terapi <span class="text-danger">*</span>
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
