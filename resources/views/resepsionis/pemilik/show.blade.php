@extends('layouts.lte.main')

@section('page-title', 'Detail Pemilik')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pemilik.index') }}">Pemilik</a></li>
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
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Detail Pemilik</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless detail-table">
                        <tr>
                            <th style="width: 35%;"><i class="bi bi-key-fill me-2"></i>ID Pemilik</th>
                            <td><span class="badge" style="background-color: rgba(98, 142, 203, 0.2); color: #628ECB;">{{ $pemilik->idpemilik }}</span></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-person-fill me-2"></i>Nama</th>
                            <td><strong class="text-dark">{{ $pemilik->nama }}</strong></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-envelope-fill me-2"></i>Email</th>
                            <td><a href="mailto:{{ $pemilik->email }}" style="color: #628ECB; text-decoration: none;">{{ $pemilik->email }}</a></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-telephone-fill me-2"></i>No. WhatsApp</th>
                            <td><a href="https://wa.me/{{ str_replace(['-', ' '], '', $pemilik->no_wa) }}" style="color: #628ECB; text-decoration: none;" target="_blank">{{ $pemilik->no_wa }}</a></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-geo-alt-fill me-2"></i>Alamat</th>
                            <td>{{ $pemilik->alamat }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-top" style="background-color: #F0F3FA;">
                    <div class="d-flex gap-2">
                        <a href="{{ route('resepsionis.pemilik.edit', $pemilik->idpemilik) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </a>
                        <a href="{{ route('resepsionis.pemilik.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
