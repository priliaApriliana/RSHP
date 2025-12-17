@extends('layouts.lte.main')


@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')
<style>
    :root {
        --primary-blue: #628ECB;
        --dark-blue: #395686;
        --soft-blue: #F0F3FA;
    }

    .detail-label {
        color: var(--primary-blue);
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: .5rem;
    }

    .detail-value {
        font-weight: 500;
        color: #212529;
    }

    .detail-card {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 20px rgba(57, 86, 134, 0.12);
    }

    .detail-row {
        padding: 1rem 0;
        border-bottom: 1px solid #e9ecef;
    }

    .detail-row:last-child {
        border-bottom: none;
    }
</style>

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">

            <div class="card detail-card">
                {{-- Header --}}
                <div class="card-header text-white"
                     style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));">
                    <h5 class="mb-0">
                        <i class="bi bi-person-badge-fill me-2"></i> Detail Pemilik
                    </h5>
                </div>

                {{-- Body --}}
                <div class="card-body px-4">

                    <div class="detail-row row">
                        <div class="col-5 detail-label">
                            <i class="bi bi-key-fill"></i> ID Pemilik
                        </div>
                        <div class="col-7 detail-value">
                            <span class="badge bg-primary bg-opacity-10 text-primary">
                                {{ $pemilik->idpemilik }}
                            </span>
                        </div>
                    </div>

                    <div class="detail-row row">
                        <div class="col-5 detail-label">
                            <i class="bi bi-person-fill"></i> Nama
                        </div>
                        <div class="col-7 detail-value">
                            {{ $pemilik->nama }}
                        </div>
                    </div>

                    <div class="detail-row row">
                        <div class="col-5 detail-label">
                            <i class="bi bi-envelope-fill"></i> Email
                        </div>
                        <div class="col-7 detail-value">
                            <a href="mailto:{{ $pemilik->email }}" class="text-decoration-none text-primary">
                                {{ $pemilik->email }}
                            </a>
                        </div>
                    </div>

                    <div class="detail-row row">
                        <div class="col-5 detail-label">
                            <i class="bi bi-whatsapp"></i> No. WhatsApp
                        </div>
                        <div class="col-7 detail-value">
                            <a href="https://wa.me/{{ str_replace(['-', ' '], '', $pemilik->no_wa) }}"
                               target="_blank"
                               class="text-decoration-none text-success">
                                {{ $pemilik->no_wa }}
                            </a>
                        </div>
                    </div>

                    <div class="detail-row row">
                        <div class="col-5 detail-label">
                            <i class="bi bi-geo-alt-fill"></i> Alamat
                        </div>
                        <div class="col-7 detail-value">
                            {{ $pemilik->alamat }}
                        </div>
                    </div>

                </div>

                {{-- Footer --}}
                <div class="card-footer bg-light d-flex justify-content-between">
                    <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Kembali
                    </a>

                    <a href="{{ route('resepsionis.pemilik.edit', $pemilik->idpemilik) }}"
                       class="btn btn-warning">
                        <i class="bi bi-pencil-square me-2"></i>Edit Data
                    </a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
