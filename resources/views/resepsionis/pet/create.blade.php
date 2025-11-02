@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content">
    <div class="container mt-4">
        <h3 class="mb-4 fw-bold text-primary">Form Registrasi Pet</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('resepsionis.pet.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pet</label>
                <input type="text" name="nama" id="nama" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="warna_tanda" class="form-label">Warna / Tanda Khusus</label>
                <input type="text" name="warna_tanda" id="warna_tanda" class="form-control">
            </div>

            <div class="mb-3">
                <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                    <option value="">-- Pilih --</option>
                    <option value="J">Jantan</option>
                    <option value="B">Betina</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="idpemilik" class="form-label">Pemilik</label>
                <select name="idpemilik" id="idpemilik" class="form-control" required>
                    <option value="">-- Pilih Pemilik --</option>
                    @foreach ($pemilik as $p)
                        <option value="{{ $p->idpemilik }}">
                            {{ $p->user->nama ?? 'Tanpa User' }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="idras_hewan" class="form-label">Ras Hewan</label>
                <select name="idras_hewan" id="idras_hewan" class="form-control" required>
                    <option value="">-- Pilih Ras --</option>
                    @foreach ($rasHewan as $r)
                        <option value="{{ $r->idras_hewan }}">
                            {{ $r->nama_ras }} ({{ $r->jenisHewan->nama_jenis_hewan ?? 'Tanpa Jenis' }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
</div>
@endsection
