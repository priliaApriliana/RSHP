@extends('layouts.lte.main')

@section('page-title', 'Hewan Saya')

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

    .pet-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.25rem;
    }

    .pet-card {
        background: white;
        border-radius: 12px;
        padding: 1.25rem;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        border: 1px solid #e2e8f0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .pet-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #628ECB 0%, #8AAEE0 100%);
    }

    .pet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 4px 12px rgba(98, 142, 203, 0.15);
        border-color: #628ECB;
    }

    .pet-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #FF6B9D 0%, #FFB6C1 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        box-shadow: 0 2px 8px rgba(255, 107, 157, 0.25);
    }

    .pet-avatar i {
        font-size: 1.75rem;
        color: white;
    }

    .pet-name {
        text-align: center;
        font-size: 1.125rem;
        font-weight: 600;
        color: #395886;
        margin-bottom: 1rem;
    }

    .pet-info {
        display: flex;
        flex-direction: column;
        gap: 0.625rem;
    }

    .pet-info-item {
        display: flex;
        align-items: center;
        padding: 0.5rem;
        background: #F0F3FA;
        border-radius: 8px;
        gap: 0.625rem;
    }

    .pet-info-icon {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #628ECB 0%, #8AAEE0 100%);
        border-radius: 6px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .pet-info-icon i {
        color: white;
        font-size: 0.8rem;
    }

    .pet-info-content {
        flex: 1;
        min-width: 0;
    }

    .pet-info-label {
        font-size: 0.6875rem;
        color: #628ECB;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.3px;
        line-height: 1;
        margin-bottom: 0.25rem;
    }

    .pet-info-value {
        font-size: 0.8125rem;
        color: #395886;
        font-weight: 600;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
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
            <h1><i class="bi bi-heart-fill"></i> Hewan Peliharaan Saya</h1>
            <p>Kelola informasi hewan peliharaan Anda</p>
        </div>
        <div class="col-md-3 text-end d-none d-md-block">
            <i class="bi bi-heart-pulse-fill" style="font-size: 3rem; opacity: 0.25;"></i>
        </div>
    </div>
</div>

<!-- Pet Grid -->
@if(count($pet) > 0)
    <div class="pet-grid">
        @foreach($pet as $p)
        <div class="pet-card">
            <div class="pet-avatar">
                <i class="bi bi-heart-fill"></i>
            </div>
            
            <div class="pet-name">{{ $p->nama }}</div>
            
            <div class="pet-info">
                <div class="pet-info-item">
                    <div class="pet-info-icon">
                        <i class="bi bi-tag-fill"></i>
                    </div>
                    <div class="pet-info-content">
                        <div class="pet-info-label">Ras</div>
                        <div class="pet-info-value">{{ $p->nama_ras }}</div>
                    </div>
                </div>

                <div class="pet-info-item">
                    <div class="pet-info-icon">
                        <i class="bi bi-grid-fill"></i>
                    </div>
                    <div class="pet-info-content">
                        <div class="pet-info-label">Jenis</div>
                        <div class="pet-info-value">{{ $p->nama_jenis_hewan }}</div>
                    </div>
                </div>

                <div class="pet-info-item">
                    <div class="pet-info-icon">
                        <i class="bi bi-calendar-heart-fill"></i>
                    </div>
                    <div class="pet-info-content">
                        <div class="pet-info-label">Tanggal Lahir</div>
                        <div class="pet-info-value">
                            @if($p->tanggal_lahir)
                                {{ \Carbon\Carbon::parse($p->tanggal_lahir)->format('d M Y') }}
                            @else
                                <span style="color: #8AAEE0;">Tidak diketahui</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@else
    <div class="empty-state">
        <div class="empty-state-icon">
            <i class="bi bi-heart-pulse"></i>
        </div>
        <h5>Belum Ada Hewan Peliharaan</h5>
        <p>Anda belum memiliki data hewan peliharaan</p>
    </div>
@endif

@endsection