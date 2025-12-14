@extends('layouts.lte.main')

@section('page-title', 'Edit Jenis Hewan')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.jenishewan.index') }}">Jenis Hewan</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('content')

<div class="row">
    <div class="col-md-8 offset-md-2">

        <div class="card">

            {{-- HEADER --}}
            <div class="card-header">
                <h3 class="card-title mb-0">
                    <i class="bi bi-pencil-square"></i> Edit Jenis Hewan
                </h3>
            </div>

            {{-- FORM --}}
            <form action="{{ route('admin.jenishewan.update', $data->idjenis_hewan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card-body">

                    {{-- Error Validation --}}
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


                    {{-- Nama Jenis Hewan --}}
                    <div class="mb-3">
                        <label for="nama_jenis_hewan" class="form-label">
                            Nama Jenis Hewan <span class="text-danger">*</span>
                        </label>

                        <input type="text"
                               id="nama_jenis_hewan"
                               name="nama_jenis_hewan"
                               class="form-control @error('nama_jenis_hewan') is-invalid @enderror"
                               placeholder="Masukkan nama jenis hewan"
                               value="{{ old('nama_jenis_hewan', $data->nama_jenis_hewan) }}"
                               required>

                        @error('nama_jenis_hewan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                </div> {{-- END CARD BODY --}}

                {{-- FOOTER --}}
                <div class="card-footer d-flex justify-content-between">
                    <a href="{{ route('admin.jenishewan.index') }}" class="btn btn-secondary">
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
