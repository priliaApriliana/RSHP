@extends('layouts.lte.main')

@section('page-title', 'Riwayat Rekam Medis')

@section('content')

<style>
    .card {
        border: none;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(57, 88, 134, 0.08);
    }

    .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: white;
        border-radius: 12px 12px 0 0 !important;
        padding: 1.25rem;
    }

    .card-title {
        font-weight: 600;
        margin: 0;
        font-size: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background-color: #D5DEEF;
        color: #395886;
        font-weight: 600;
        border-bottom: 2px solid #628ECB;
        padding: 1rem;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #F0F3FA;
        transform: translateX(5px);
    }

    .table td {
        padding: 1rem;
        vertical-align: middle;
        color: #395886;
    }

    .pet-badge {
        background-color: #D5DEEF;
        color: #395886;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pet-badge i {
        color: #8AAEE0;
    }

    .date-badge {
        background-color: #F0F3FA;
        color: #628ECB;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-weight: 500;
        font-size: 0.875rem;
        display: inline-block;
    }

    .empty-state {
        padding: 3rem;
        text-align: center;
        color: #628ECB;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }
</style>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-file-medical"></i> Riwayat Rekam Medis
        </h3>
    </div>

    <div class="card-body table-responsive p-0">
        @if(count($rekam) > 0)
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th style="width: 180px;">Hewan</th>
                        <th style="width: 150px;">Tanggal</th>
                        <th>Anamnesa</th>
                        <th>Diagnosa</th>
                        <th>Temuan Klinis</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($rekam as $r)
                    <tr>
                        <td>
                            <span class="pet-badge">
                                <i class="fas fa-paw"></i>
                                {{ $r->nama_pet }}
                            </span>
                        </td>
                        <td>
                            <span class="date-badge">
                                <i class="far fa-calendar-alt me-1"></i>
                                {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}
                            </span>
                        </td>
                        <td>{{ $r->anamnesa }}</td>
                        <td><strong>{{ $r->diagnosa }}</strong></td>
                        <td>{{ $r->temuan_klinis }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-file-medical"></i>
                <h5 style="color: #395886;">Belum Ada Riwayat Rekam Medis</h5>
                <p style="color: #628ECB;">Belum ada catatan rekam medis untuk hewan peliharaan Anda.</p>
            </div>
        @endif
    </div>
</div>

@endsection