@extends('layouts.lte.main')

@section('page-title', 'Riwayat Rekam Medis')

@section('content')

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Rekam Medis</h3>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Hewan</th>
                    <th>Tanggal</th>
                    <th>Anamnesa</th>
                    <th>Diagnosa</th>
                    <th>Temuan Klinis</th>
                </tr>
            </thead>

            <tbody>
                @foreach($rekam as $r)
                <tr>
                    <td>{{ $r->temu->pet->nama }}</td>
                    <td>{{ $r->created_at }}</td>
                    <td>{{ $r->anamnesa }}</td>
                    <td>{{ $r->diagnosa }}</td>
                    <td>{{ $r->temuan_klinis }}</td>
                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection
