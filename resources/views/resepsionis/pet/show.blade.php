@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('resepsionis.dashboard') }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('resepsionis.pet.index') }}">
            <i class="bi bi-heart"></i> Pet
        </a>
    </li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')

<style>
:root {
    --primary: #628ECB;
    --secondary: #395686;
    --light: #F0F3FA;
    --border: #D5DEEF;
}

/* Card */
.detail-card {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(57, 88, 134, 0.15);
    border: none;
}

/* Header */
.detail-header {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    padding: 1.5rem 2rem;
}

.detail-header h5 {
    margin: 0;
    font-weight: 700;
}

/* Body */
.detail-body {
    padding: 2rem;
    background: white;
}

/* Info Row */
.info-row {
    display: flex;
    align-items: center;
    padding: .75rem 0;
    border-bottom: 1px dashed var(--border);
}

.info-label {
    width: 35%;
    min-width: 170px;
    font-weight: 600;
    color: var(--primary);
    display: flex;
    align-items: center;
    gap: .5rem;
}

.info-value {
    width: 65%;
    font-weight: 500;
    color: #333;
}

/* Badge */
.badge-soft {
    background: rgba(98, 142, 203, .15);
    color: var(--primary);
    padding: .4rem .8rem;
    border-radius: 8px;
    font-weight: 600;
}

.gender-male {
    background: #E3F2FD;
    color: #1976D2;
}

.gender-female {
    background: #FCE4EC;
    color: #C2185B;
}

/* Footer */
.detail-footer {
    background: var(--light);
    padding: 1.25rem 2rem;
}

/* Responsive */
@media (max-width: 768px) {
    .detail-body {
        padding: 1.25rem;
    }

    .info-row {
        flex-direction: column;
        align-items: flex-start;
    }

    .info-label,
    .info-value {
        width: 100%;
    }

    .info-label {
        margin-bottom: .3rem;
    }
}
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">

            <div class="card detail-card">
                {{-- Header --}}
                <div class="detail-header">
                    <h5>
                        <i class="bi bi-info-circle-fill me-2"></i> Detail Pet
                    </h5>
                </div>

                {{-- Body --}}
                <div class="detail-body">

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-key-fill"></i> ID Pet
                        </div>
                        <div class="info-value">
                            <span class="badge-soft">{{ $pet->idpet }}</span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-heart-fill"></i> Nama Hewan
                        </div>
                        <div class="info-value fw-bold">
                            {{ $pet->nama }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-person-fill"></i> Pemilik
                        </div>
                        <div class="info-value">
                            {{ $pet->nama_pemilik }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-diagram-3-fill"></i> Ras Hewan
                        </div>
                        <div class="info-value">
                            {{ $pet->nama_ras ?? '-' }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-tag-fill"></i> Jenis Hewan
                        </div>
                        <div class="info-value">
                            <span class="badge-soft">
                                {{ $pet->nama_jenis_hewan }}
                            </span>
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-gender-ambiguous"></i> Jenis Kelamin
                        </div>
                        <div class="info-value">
                            @if($pet->jenis_kelamin == 'J')
                                <span class="badge-soft gender-male">
                                    <i class="bi bi-gender-male"></i> Jantan
                                </span>
                            @else
                                <span class="badge-soft gender-female">
                                    <i class="bi bi-gender-female"></i> Betina
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-calendar-event-fill"></i> Tanggal Lahir
                        </div>
                        <div class="info-value">
                            {{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}
                        </div>
                    </div>

                    <div class="info-row">
                        <div class="info-label">
                            <i class="bi bi-palette-fill"></i> Warna / Tanda
                        </div>
                        <div class="info-value">
                            {{ $pet->warna_tanda ?? '-' }}
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="detail-footer d-flex gap-2">
                    <a href="{{ route('resepsionis.pet.edit', $pet->idpet) }}" class="btn btn-warning">
                        <i class="bi bi-pencil-square me-1"></i> Edit
                    </a>
                    <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i> Kembali
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection
