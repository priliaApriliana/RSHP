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

    .timeline {
        position: relative;
        padding-left: 35px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 13px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(180deg, #628ECB 0%, #D5DEEF 100%);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 1.5rem;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-marker {
        position: absolute;
        left: -28px;
        top: 6px;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #628ECB 0%, #8AAEE0 100%);
        border-radius: 50%;
        border: 3px solid white;
        box-shadow: 0 2px 4px rgba(98, 142, 203, 0.25);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .timeline-marker i {
        color: white;
        font-size: 0.7rem;
    }

    .timeline-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        transition: all 0.3s ease;
    }

    .timeline-card:hover {
        transform: translateX(3px);
        box-shadow: 0 3px 10px rgba(98, 142, 203, 0.12);
        border-color: #628ECB;
    }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.875rem;
        border-bottom: 1px solid #F0F3FA;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .pet-badge {
        background: linear-gradient(135deg, #FF6B9D 0%, #FFB6C1 100%);
        color: white;
        padding: 0.4rem 0.875rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.8125rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
        box-shadow: 0 2px 4px rgba(255, 107, 157, 0.25);
    }

    .pet-badge i {
        font-size: 0.8125rem;
    }

    .date-badge {
        background: #F0F3FA;
        color: #628ECB;
        padding: 0.4rem 0.875rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.75rem;
        display: inline-flex;
        align-items: center;
        gap: 0.375rem;
    }

    .date-badge i {
        font-size: 0.75rem;
    }

    .timeline-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 0.875rem;
    }

    .info-block {
        background: #F0F3FA;
        padding: 0.875rem;
        border-radius: 8px;
        border-left: 3px solid #628ECB;
    }

    .info-block-label {
        font-size: 0.6875rem;
        color: #628ECB;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        margin-bottom: 0.375rem;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .info-block-label i {
        font-size: 0.75rem;
    }

    .info-block-value {
        color: #395886;
        font-weight: 500;
        font-size: 0.8125rem;
        line-height: 1.4;
    }

    .empty-state {
        background: white;
        border-radius: 12px;
        padding: 3rem 2rem;
        text-align: center;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
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
            <h1><i class="bi bi-clock-history"></i> Riwayat Pemeriksaan</h1>
            <p>Lihat riwayat rekam medis hewan peliharaan Anda</p>
        </div>
        <div class="col-md-3 text-end d-none d-md-block">
            <i class="bi bi-file-medical-fill" style="font-size: 3rem; opacity: 0.25;"></i>
        </div>
    </div>
</div>

<!-- Timeline -->
@if(count($rekam) > 0)
    <div class="timeline">
        @foreach($rekam as $r)
        <div class="timeline-item">
            <div class="timeline-marker">
                <i class="bi bi-file-medical-fill"></i>
            </div>
            
            <div class="timeline-card">
                <div class="timeline-header">
                    <span class="pet-badge">
                        <i class="bi bi-heart-fill"></i>
                        {{ $r->nama_pet }}
                    </span>
                    <span class="date-badge">
                        <i class="bi bi-calendar-fill"></i>
                        {{ \Carbon\Carbon::parse($r->created_at)->format('d M Y') }}
                    </span>
                </div>

                <div class="timeline-content">
                    <div class="info-block">
                        <div class="info-block-label">
                            <i class="bi bi-chat-dots-fill"></i> Anamnesa
                        </div>
                        <div class="info-block-value">{{ $r->anamnesa }}</div>
                    </div>

                    <div class="info-block">
                        <div class="info-block-label">
                            <i class="bi bi-clipboard-pulse"></i> Diagnosa
                        </div>
                        <div class="info-block-value">{{ $r->diagnosa }}</div>
                    </div>

                    <div class="info-block">
                        <div class="info-block-label">
                            <i class="bi bi-search"></i> Temuan Klinis
                        </div>
                        <div class="info-block-value">{{ $r->temuan_klinis }}</div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="bi bi-clipboard2-x"></i>
        </div>
        <h5>Belum Ada Riwayat Pemeriksaan</h5>
        <p>Belum ada catatan rekam medis untuk hewan peliharaan Anda</p>
    </div>
@endif

@endsection