@extends('layouts.lte.main')

@section('page-title', 'Daftar Pasien Dokter')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Pasien Antrian</h3>
    </div>

    <div class="card-body">

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No Urut</th>
                    <th>Nama Hewan</th>
                    <th>Pemilik</th>
                    <th>Waktu Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($antrian as $a)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $a->pet->nama }}</td>
                    <td>{{ $a->pet->pemilik->user->nama }}</td>
                    <td>{{ $a->waktu_daftar }}</td>

                    <td>
                        <a href="{{ route('dokter.rekammedis.create', ['idreservasi_dokter' => $a->idreservasi_dokter]) }}"
                           class="btn btn-primary btn-sm">
                            Periksa
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
    