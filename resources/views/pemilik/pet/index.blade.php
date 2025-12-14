@extends('layouts.lte.main')

@section('page-title', 'Daftar Hewan')

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

    .pet-name {
        font-weight: 600;
        color: #395886;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .pet-name i {
        color: #8AAEE0;
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
            <i class="fas fa-paw"></i> Daftar Hewan Anda
        </h3>
    </div>

    <div class="card-body table-responsive p-0">
        @if(count($pet) > 0)
            <table class="table table-hover">
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
                        <td>
                            <div class="pet-name">
                                <i class="fas fa-heart"></i>
                                {{ $p->nama }}
                            </div>
                        </td>
                        <td>{{ $p->nama_ras }}</td>
                        <td>{{ $p->nama_jenis_hewan }}</td>
                        <td>
                            @if($p->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <i class="fas fa-paw"></i>
                <h5 style="color: #395886;">Belum Ada Hewan Peliharaan</h5>
                <p style="color: #628ECB;">Anda belum memiliki data hewan peliharaan.</p>
            </div>
        @endif
    </div>
</div>

@endsection