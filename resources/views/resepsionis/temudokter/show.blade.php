@extends('layouts.lte.main')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.temudokter.index') }}">Temu Dokter</a></li>
    <li class="breadcrumb-item active">Detail</li>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/css/resepsionis/show.css') }}">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                    <h5 class="mb-0"><i class="bi bi-info-circle-fill me-2"></i>Detail Temu Dokter</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless detail-table">
                        <tr>
                            <th style="width: 35%;"><i class="bi bi-hash me-2"></i>No. Urut</th>
                            <td><span class="badge" style="background-color: rgba(98, 142, 203, 0.2); color: #628ECB;">{{ $temuDokter->no_urut }}</span></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-calendar-fill me-2"></i>Tanggal Daftar</th>
                            <td>
                                {{ \Carbon\Carbon::parse($temuDokter->waktu_daftar)->format('d/m/Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-heart me-2"></i>Nama Hewan</th>
                            <td><strong class="text-dark">{{ $temuDokter->nama_hewan }}</strong></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-person-fill me-2"></i>Nama Pemilik</th>
                            <td>{{ $temuDokter->nama_pemilik }}</td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-stethoscope me-2"></i>Dokter</th>
                            <td><span class="badge" style="background: linear-gradient(135deg, #8AAEE0 0%, #B1C9EF 100%); color: white;">dr. {{ $temuDokter->nama_dokter }}</span></td>
                        </tr>
                        <tr>
                            <th><i class="bi bi-info-circle me-2"></i>Status</th>
                            <td>
                                @if($temuDokter->status == 'A')
                                    <span class="badge bg-warning">Antri</span>
                                @elseif($temuDokter->status == 'P')
                                    <span class="badge bg-info">Proses</span>
                                @elseif($temuDokter->status == 'S')
                                    <span class="badge bg-success">Selesai</span>
                                @elseif($temuDokter->status == 'B')
                                    <span class="badge bg-danger">Batal</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer border-top" style="background-color: #F0F3FA;">
                    <div class="d-flex gap-2">
                        <a href="{{ route('resepsionis.temudokter.edit', $temuDokter->idreservasi_dokter) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Edit
                        </a>
                        <a href="{{ route('resepsionis.temudokter.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
