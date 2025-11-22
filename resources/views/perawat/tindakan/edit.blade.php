@extends('layouts.lte.main')

@section('page-title', 'Edit Tindakan Terapi')

@section('content')

<h3 class="fw-bold mb-3">Edit Kode Tindakan Terapi</h3>

<div class="card">
    <div class="card-body">

        <form action="{{ route('perawat.tindakan.update', $data->idkode_tindakan_terapi) }}"
              method="POST">
            @csrf
            @method('PUT')

            {{-- KODE --}}
            <div class="mb-3">
                <label class="form-label">Kode <span class="text-danger">*</span></label>
                <input type="text" name="kode"
                       value="{{ $data->kode }}"
                       class="form-control @error('kode') is-invalid @enderror">

                @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            {{-- DESKRIPSI --}}
            <div class="mb-3">
                <label class="form-label">Deskripsi <span class="text-danger">*</span></label>
                <textarea name="deskripsi_tindakan_terapi"
                          class="form-control"
                          rows="3">{{ $data->deskripsi_tindakan_terapi }}</textarea>
            </div>

            {{-- KATEGORI --}}
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="idkategori" class="form-control">
                    @foreach ($kategori as $k)
                        <option value="{{ $k->idkategori }}"
                            {{ $k->idkategori == $data->idkategori ? 'selected' : '' }}>
                            {{ $k->nama_kategori }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- KATEGORI KLINIS --}}
            <div class="mb-3">
                <label class="form-label">Kategori Klinis</label>
                <select name="idkategori_klinis" class="form-control">
                    @foreach ($kategoriKlinis as $kk)
                        <option value="{{ $kk->idkategori_klinis }}"
                            {{ $kk->idkategori_klinis == $data->idkategori_klinis ? 'selected' : '' }}>
                            {{ $kk->nama_kategori_klinis }}
                        </option>
                    @endforeach
                </select>
            </div>

            <a href="{{ route('perawat.tindakan.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-warning float-end">
                <i class="bi bi-save"></i> Update
            </button>

        </form>

    </div>
</div>

@endsection
