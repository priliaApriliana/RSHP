@extends('layouts.lte.main')

@section('page-title', 'Edit Ras Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.rashewan.index') }}">Ras Hewan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Ras Hewan
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.rashewan.update', $ras->idras_hewan) }}" method="POST">
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

                    {{-- Nama Ras --}}
                    <div class="mb-3">
                        <label for="nama_ras" class="form-label">
                            Nama Ras <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="nama_ras"
                               name="nama_ras"
                               class="form-control @error('nama_ras') is-invalid @enderror"
                               placeholder="Contoh: Persia, Golden Retriever"
                               value="{{ old('nama_ras', $ras->nama_ras) }}"
                               required>

                        @error('nama_ras')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Pilih Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="idjenis_hewan" class="form-label">
                            Jenis Hewan <span class="text-danger">*</span>
                        </label>

                        <select name="idjenis_hewan"
                                id="idjenis_hewan"
                                class="form-select @error('idjenis_hewan') is-invalid @enderror"
                                required>

                            <option value="" disabled>-- Pilih Jenis Hewan --</option>

                            @foreach ($jenisHewan as $j)
                                <option value="{{ $j->idjenis_hewan }}"
                                    {{ old('idjenis_hewan', $ras->idjenis_hewan) == $j->idjenis_hewan ? 'selected' : '' }}>
                                    {{ $j->nama_jenis_hewan }}
                                </option>
                            @endforeach

                        </select>

                        @error('idjenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.rashewan.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>

                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

@endsection
