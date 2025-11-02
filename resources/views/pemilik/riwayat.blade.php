@extends('layouts.admin')

@section('content')
@include('layouts.sidebar')

<div class="main-content" id="mainContent">
    <div class="container mt-4">
        <h3 class="fw-bold text-primary mb-4">
            <i class="fas fa-history"></i> Riwayat Pemeriksaan
        </h3>

        <div class="card shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Nama Pet</th>
                                <th>Dokter</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($riwayat as $index => $r)
                            <tr>
                                <td>{{ $riwayat->firstItem() + $index }}</td>
                                <td>{{ $r->waktu_daftar->format('d/m/Y') }}</td>
                                <td>{{ $r->pet->nama }}</td>
                                <td>{{ $r->dokter->user->nama ?? '-' }}</td>
                                <td>
                                    @if($r->status == 'S')
                                        <span class="badge bg-success">Selesai</span>
                                    @elseif($r->status == 'P')
                                        <span class="badge bg-warning">Pending</span>
                                    @else
                                        <span class="badge bg-secondary">Menunggu</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted">
                                    Belum ada riwayat pemeriksaan
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                {{ $riwayat->links() }}
            </div>
        </div>
    </div>
</div>
@endsection