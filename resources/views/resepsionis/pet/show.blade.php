@extends('layouts.lte.main')

@section('page-title', 'Detail Pet')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pet.index') }}">Pet</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('content')

<style>
    :root {
        --primary-blue: #628ECB;
        --light-blue: #8AAEE0;
        --lighter-blue: #B1C9EF;
        --lightest-blue: #D5DEEF;
        --very-light-blue: #F0F3FA;
        --dark-blue: #395686;
    }
    
    .detail-table th {
        color: #628ECB;
        font-weight: 600;
        background-color: #F0F3FA;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Detail Pet</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless detail-table">
                        <tr>
                            <th style="width: 35%;"><i class="bi bi-key-fill me-2"></i>ID Pet</th>
                            <td><span class="badge" style="background-color: rgba(98, 142, 203, 0.2); color: #628ECB;">{{ $pet->idpet }}</span></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-heart me-2"></i>Nama Hewan</th>
                            <td><strong class="text-dark">{{ $pet->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-person-fill me-2"></i>Pemilik</th>
                            <td>{{ $pet->nama_pemilik }}</td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-collection me-2"></i>Ras</th>
                            <td>{{ $pet->nama_ras }}</td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-tag me-2"></i>Jenis</th>
                            <td><span class="badge" style="background: linear-gradient(135deg, #8AAEE0 0%, #B1C9EF 100%); color: white;">{{ $pet->nama_jenis_hewan }}</span></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-gender-ambiguous me-2"></i>Jenis Kelamin</th>
                            <td>
                                @if($pet->jenis_kelamin == 'J')
                                    <span class="badge" style="background-color: rgba(138, 174, 224, 0.3); color: #8AAEE0;">Jantan</span>
                                @else
                                    <span class="badge" style="background-color: rgba(213, 222, 239, 0.5); color: #D5DEEF;">Betina</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-calendar-fill me-2"></i>Tanggal Lahir</th>
                            <td>{{ \Carbon\Carbon::parse($pet->tanggal_lahir)->format('d/m/Y') }}</td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-palette me-2"></i>Warna/Tanda</th>
                            <td>{{ $pet->warna_tanda ?? '-' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-top" style="background-color: #F0F3FA;">
                    <div class="d-flex gap-2">
                        <a href="{{ route('resepsionis.pet.edit', $pet->idpet) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </a>
                        <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
