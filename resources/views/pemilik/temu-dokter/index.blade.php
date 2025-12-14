@extends('layouts.lte.main')

@section('page-title', 'Jadwal Temu Dokter')

@section('content')

<style>
    .card-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: white;
    }

    .table thead th {
        background-color: #D5DEEF;
        color: #395886;
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: #F0F3FA;
    }

    .badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 500;
        font-size: 0.875rem;
    }

    .badge-pending {
        background-color: #FFF3CD;
        color: #856404;
        border: 1px solid #FFE69C;
    }

    .badge-confirmed {
        background-color: #D1ECF1;
        color: #0C5460;
        border: 1px solid #BEE5EB;
    }

    .badge-selesai {
        background-color: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
    }

    .badge-batal {
        background-color: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }

    .no-urut-badge {
        background-color: #8AAEE0;
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 50%;
        font-weight: 600;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
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

<!-- Content Header -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0" style="color: #395886;">
                    <i class="fas fa-calendar-check me-2"></i>Jadwal Temu Dokter
                </h1>
            </div>
        </div>
    </div>
</div>

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fas fa-calendar-alt me-2"></i>Jadwal Temu Dokter Saya
                        </h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        @if(count($temuDokter) > 0)
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 80px;">No. Urut</th>
                                        <th style="width: 150px;">Waktu Daftar</th>
                                        <th>Hewan</th>
                                        <th>Dokter</th>
                                        <th style="width: 120px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($temuDokter as $temu)
                                    <tr>
                                        <td class="text-center">
                                            <span class="no-urut-badge">
                                                {{ $temu->no_urut }}
                                            </span>
                                        </td>
                                        <td>
                                            <i class="bi bi-clock me-1"></i>
                                            {{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M Y, H:i') }}
                                        </td>
                                        <td>
                                            <i class="fas fa-heart me-1" style="color: #8AAEE0;"></i>
                                            <strong>{{ $temu->nama_pet }}</strong>
                                        </td>
                                        <td>
                                            <i class="fas fa-user-md me-1" style="color: #628ECB;"></i>
                                            {{ $temu->nama_dokter ?? 'Belum ditentukan' }}
                                        </td>
                                        <td>
                                            @php
                                                // Sesuaikan dengan status di database Anda
                                                $statusText = $temu->status;
                                                $statusClass = 'badge-pending';
                                                
                                                // Contoh mapping status (sesuaikan dengan DB Anda)
                                                if ($temu->status == 'A') {
                                                    $statusText = 'Menunggu';
                                                    $statusClass = 'badge-pending';
                                                } elseif ($temu->status == 'B') {
                                                    $statusText = 'Dikonfirmasi';
                                                    $statusClass = 'badge-confirmed';
                                                } elseif ($temu->status == 'C') {
                                                    $statusText = 'Selesai';
                                                    $statusClass = 'badge-selesai';
                                                } elseif ($temu->status == 'D') {
                                                    $statusText = 'Dibatalkan';
                                                    $statusClass = 'badge-batal';
                                                }
                                            @endphp
                                            <span class="badge {{ $statusClass }}">
                                                {{ $statusText }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-calendar-x"></i>
                                <h5 style="color: #395886;">Belum Ada Jadwal Temu Dokter</h5>
                                <p style="color: #628ECB;">Anda belum memiliki jadwal pertemuan dengan dokter.</p>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection