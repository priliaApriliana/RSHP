@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('admin.dokter.index') }}">Dokter</a></li>
    <li class="breadcrumb-item active">Edit</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/admin/edit.css') }}">
@endsection

@section('content')

<div class="container-fluid px-2">
    <div class="form-wrapper">
        <div class="form-card">

            {{-- HEADER --}}
            <div class="form-header">
                <h3 class="form-header-title">
                    <i class="fas fa-user-md"></i>
                    Edit Data Dokter
                </h3>
            </div>

            <form action="{{ route('admin.dokter.update', $dokter->id_dokter) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-body">

                    {{-- ALAMAT --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            Alamat <span class="required-star">*</span>
                        </label>
                        <input type="text"
                               name="alamat"
                               value="{{ old('alamat', $dokter->alamat) }}"
                               class="form-input-custom"
                               required>
                    </div>

                    {{-- NO HP --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            No HP <span class="required-star">*</span>
                        </label>
                        <input type="text"
                               name="no_hp"
                               value="{{ old('no_hp', $dokter->no_hp) }}"
                               class="form-input-custom"
                               required>
                    </div>

                    {{-- BIDANG DOKTER --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            Bidang Dokter <span class="required-star">*</span>
                        </label>
                        <input type="text"
                               name="bidang_dokter"
                               value="{{ old('bidang_dokter', $dokter->bidang_dokter) }}"
                               class="form-input-custom"
                               required>
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div class="input-group-wrapper mb-3">
                        <label class="form-label-custom">
                            Jenis Kelamin <span class="required-star">*</span>
                        </label>
                        <select name="jenis_kelamin" class="form-input-custom" required>
                            <option value="L" {{ $dokter->jenis_kelamin == 'L' ? 'selected' : '' }}>
                                Laki-laki
                            </option>
                            <option value="P" {{ $dokter->jenis_kelamin == 'P' ? 'selected' : '' }}>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    {{-- USER --}}
                    <div class="input-group-wrapper">
                        <label class="form-label-custom">
                            User <span class="required-star">*</span>
                        </label>
                        <select name="id_user" class="form-input-custom" required>
                            @foreach($user as $u)
                                <option value="{{ $u->iduser }}"
                                    {{ $dokter->id_user == $u->iduser ? 'selected' : '' }}>
                                    {{ $u->nama }} ({{ $u->email }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                {{-- FOOTER --}}
                <div class="form-footer">
                    <a href="{{ route('admin.dokter.index') }}"
                       class="btn-custom btn-back-custom">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </a>

                    <button type="submit"
                            class="btn-custom btn-update-custom">
                        <i class="bi bi-check-circle-fill"></i>
                        Update
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>


@endsection
