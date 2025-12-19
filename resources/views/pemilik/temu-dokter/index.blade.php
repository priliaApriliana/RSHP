@extends('layouts.lte.main')

@section('content')

<style>
    .page-header {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        border-radius: 12px;
        color: white;
        padding: 1.25rem 1.5rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 8px rgba(98, 142, 203, 0.2);
    }
    
    .page-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }
    
    .page-header p {
        opacity: 0.9;
        margin-bottom: 0;
        font-size: 0.875rem;
    }

    .modern-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e2e8f0;
    }

    .modern-card-header {
        background: linear-gradient(135deg, #F0F3FA 0%, #E8EEF8 100%);
        padding: 0.875rem 1.25rem;
        border-bottom: 1px solid #D5DEEF;
    }

    .modern-card-header h3 {
        color: #395886;
        font-weight: 600;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1rem;
    }

    .modern-table {
        width: 100%;
        margin: 0;
        font-size: 0.875rem;
    }

    .modern-table thead th {
        background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
        color: white;
        font-weight: 600;
        padding: 0.75rem 1rem;
        text-align: left;
        border: none;
        font-size: 0.8125rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .modern-table tbody tr {
        transition: all 0.2s ease;
        border-bottom: 1px solid #e2e8f0;
    }

    .modern-table tbody tr:hover {
        background: linear-gradient(90deg, #F0F3FA 0%, transparent 100%);
        transform: translateX(3px);
    }

    .modern-table tbody tr:last-child {
        border-bottom: none;
    }

    .modern-table td {
        padding: 0.875rem 1rem;
        vertical-align: middle;
        color: #395886;
    }

    .no-urut-badge {
        background: linear-gradient(135deg, #628ECB 0%, #8AAEE0 100%);
        color: white;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
        font-size: 0.9rem;
        box-shadow: 0 2px 4px rgba(98, 142, 203, 0.25);
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 0.375rem;
        font-size: 0.875rem;
    }

    .info-item i {
        color: #628ECB;
        font-size: 0.875rem;
    }

    .pet-name {
        font-weight: 600;
        color: #395886;
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .pet-name i {
        color: #FF6B9D;
        font-size: 0.875rem;
    }

    .dokter-name {
        display: flex;
        align-items: center;
        gap: 0.375rem;
    }

    .dokter-name i {
        color: #628ECB;
        font-size: 0.875rem;
    }

    .status-badge {
        padding: 0.375rem 0.75rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-badge i {
        font-size: 0.75rem;
    }

    .status-pending {
        background: #FFF3CD;
        color: #856404;
        border: 1px solid #FFE69C;
    }

    .status-confirmed {
        background: #D1ECF1;
        color: #0C5460;
        border: 1px solid #BEE5EB;
    }

    .status-selesai {
        background: #D4EDDA;
        color: #155724;
        border: 1px solid #C3E6CB;
    }

    .status-batal {
        background: #F8D7DA;
        color: #721C24;
        border: 1px solid #F5C6CB;
    }

    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #F0F3FA 0%, #E8EEF8 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .empty-state-icon i {
        font-size: 2rem;
        color: #8AAEE0;
    }

    .empty-state h5 {
        color: #395886;
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.125rem;
    }

    .empty-state p {
        color: #628ECB;
        margin: 0;
        font-size: 0.875rem;
    }
</style>

<!-- Page Header -->
<div class="page-header">
    <div class="row align-items-center">
        <div class="col-md-9">
            <h1><i class="bi bi-calendar-check-fill"></i> Jadwal Temu Dokter</h1>
            <p>Lihat dan kelola jadwal pertemuan Anda dengan dokter</p>
        </div>
        <div class="col-md-3 text-end d-none d-md-block">
            <i class="bi bi-calendar-event" style="font-size: 3rem; opacity: 0.25;"></i>
        </div>
    </div>
</div>

<!-- Main Card -->
<div class="modern-card">
    <div class="modern-card-header">
        <h3>
            <i class="bi bi-list-check"></i>
            Daftar Jadwal Temu Dokter
        </h3>
    </div>

    <div class="table-responsive">
        @if(count($temuDokter) > 0)
            <table class="modern-table">
                <thead>
                    <tr>
                        <th style="width: 80px;">No. Urut</th>
                        <th style="width: 160px;">Waktu Daftar</th>
                        <th>Hewan</th>
                        <th>Dokter</th>
                        <th style="width: 130px;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($temuDokter as $temu)
                    <tr>
                        <td class="text-center">
                            <div class="no-urut-badge">
                                {{ $temu->no_urut }}
                            </div>
                        </td>
                        <td>
                            <div class="info-item">
                                <i class="bi bi-clock-fill"></i>
                                <span>{{ \Carbon\Carbon::parse($temu->waktu_daftar)->format('d M Y, H:i') }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="pet-name">
                                <i class="bi bi-heart-fill"></i>
                                {{ $temu->nama_pet }}
                            </div>
                        </td>
                        <td>
                            <div class="dokter-name">
                                <i class="bi bi-person-badge-fill"></i>
                                {{ $temu->nama_dokter ?? 'Belum ditentukan' }}
                            </div>
                        </td>
                        <td>
                            @php
                                $statusMap = [
                                    'A' => ['text' => 'Menunggu', 'class' => 'status-pending', 'icon' => 'clock-fill'],
                                    'B' => ['text' => 'Konfirmasi', 'class' => 'status-confirmed', 'icon' => 'check-circle-fill'],
                                    'C' => ['text' => 'Selesai', 'class' => 'status-selesai', 'icon' => 'check-all'],
                                    'D' => ['text' => 'Batal', 'class' => 'status-batal', 'icon' => 'x-circle-fill'],
                                ];
                                $status = $statusMap[$temu->status] ?? ['text' => $temu->status, 'class' => 'status-pending', 'icon' => 'clock-fill'];
                            @endphp
                            <span class="status-badge {{ $status['class'] }}">
                                <i class="bi bi-{{ $status['icon'] }}"></i>
                                {{ $status['text'] }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <i class="bi bi-calendar-x"></i>
                </div>
                <h5>Belum Ada Jadwal Temu Dokter</h5>
                <p>Anda belum memiliki jadwal pertemuan dengan dokter</p>
            </div>
        @endif
    </div>
</div>

@endsection