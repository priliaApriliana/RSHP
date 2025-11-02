@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-paw"></i> Hewan Peliharaan Saya
        </h3>

        <div class="row g-4">
            @forelse($pets as $pet)
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $pet->nama }}</h5>
                        <hr>
                        <p><strong>Jenis:</strong> {{ $pet->rasHewan->jenisHewan->nama_jenis_hewan ?? '-' }}</p>
                        <p><strong>Ras:</strong> {{ $pet->rasHewan->nama_ras ?? '-' }}</p>
                        <p><strong>Tanggal Lahir:</strong> {{ $pet->tanggal_lahir ? $pet->tanggal_lahir->format('d/m/Y') : '-' }}</p>
                        <p><strong>Jenis Kelamin:</strong> {{ $pet->jenis_kelamin == 'J' ? 'Jantan' : 'Betina' }}</p>
                        <p><strong>Warna/Tanda:</strong> {{ $pet->warna_tanda }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    <i class="fas fa-info-circle fa-3x mb-3"></i><br>
                    Belum ada data hewan peliharaan
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection