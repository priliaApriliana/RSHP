@extends('layouts.lte.main')

@section('page-title', 'Daftar Hewan')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Daftar Hewan Anda</h3>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nama Hewan</th>
                    <th>Ras</th>
                    <th>Jenis</th>
                    <th>Tgl Lahir</th>
                </tr>
            </thead>

            <tbody>
                @foreach($pet as $p)
                <tr>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->rasHewan->nama_ras }}</td>
                    <td>{{ $p->rasHewan->jenisHewan->nama_jenis_hewan }}</td>
                    <td>{{ $p->tanggal_lahir }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
