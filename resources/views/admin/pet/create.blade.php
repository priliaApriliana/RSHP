@extends('layouts.app')

@section('title', 'Tambah Data Pet')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><i class="fas fa-paw"></i> Tambah Data Pet</h4>
        </div>
        
        <div class="card-body">
            <!-- Tampilkan error validasi -->
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong><i class="fas fa-exclamation-triangle"></i> Terdapat kesalahan:</strong>
                    <ul class="mb-0 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('admin.pet.store') }}" method="POST">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <!-- Nama Pet -->
                        <div class="mb-3">
                            <label for="nama" class="form-label fw-bold">
                                Nama Pet <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('nama') is-invalid @enderror" 
                                   id="nama" 
                                   name="nama" 
                                   value="{{ old('nama') }}"
                                   placeholder="Contoh: Brownie"
                                   required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Tanggal Lahir -->
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label fw-bold">
                                Tanggal Lahir <span class="text-danger">*</span>
                            </label>
                            <input type="date" 
                                   class="form-control @error('tanggal_lahir') is-invalid @enderror" 
                                   id="tanggal_lahir" 
                                   name="tanggal_lahir" 
                                   value="{{ old('tanggal_lahir') }}"
                                   max="{{ date('Y-m-d') }}"
                                   required>
                            @error('tanggal_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">Tanggal tidak boleh di masa depan</small>
                        </div>

                        <!-- Warna/Tanda Khusus -->
                        <div class="mb-3">
                            <label for="warna_tanda" class="form-label fw-bold">
                                Warna/Tanda Khusus <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('warna_tanda') is-invalid @enderror" 
                                   id="warna_tanda" 
                                   name="warna_tanda" 
                                   value="{{ old('warna_tanda') }}"
                                   placeholder="Contoh: Coklat dengan bintik putih"
                                   required>
                            @error('warna_tanda')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <!-- Jenis Kelamin -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Jenis Kelamin <span class="text-danger">*</span>
                            </label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" 
                                           type="radio" 
                                           name="jenis_kelamin" 
                                           id="jantan" 
                                           value="J"
                                           {{ old('jenis_kelamin') == 'J' ? 'checked' : '' }}
                                           required>
                                    <label class="form-check-label" for="jantan">
                                        <i class="fas fa-mars text-primary"></i> Jantan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input @error('jenis_kelamin') is-invalid @enderror" 
                                           type="radio" 
                                           name="jenis_kelamin" 
                                           id="betina" 
                                           value="B"
                                           {{ old('jenis_kelamin') == 'B' ? 'checked' : '' }}
                                           required>
                                    <label class="form-check-label" for="betina">
                                        <i class="fas fa-venus text-danger"></i> Betina
                                    </label>
                                </div>
                            </div>
                            @error('jenis_kelamin')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pemilik -->
                        <div class="mb-3">
                            <label for="idpemilik" class="form-label fw-bold">
                                Pemilik <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idpemilik') is-invalid @enderror" 
                                    id="idpemilik" 
                                    name="idpemilik" 
                                    required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach($pemilik as $pemilik)
                                    <option value="{{ $pemilik->idpemilik }}" 
                                            {{ old('idpemilik') == $pemilik->idpemilik ? 'selected' : '' }}>
                                        {{ $pemilik->user->nama }} - {{ $pemilik->no_wa }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Ras Hewan -->
                        <div class="mb-3">
                            <label for="idras_hewan" class="form-label fw-bold">
                                Ras Hewan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('idras_hewan') is-invalid @enderror" 
                                    id="idras_hewan" 
                                    name="idras_hewan" 
                                    required>
                                <option value="">-- Pilih Ras Hewan --</option>
                                @foreach($ras as $ras)
                                    <option value="{{ $ras->idras_hewan }}" 
                                            {{ old('idras_hewan') == $ras->idras_hewan ? 'selected' : '' }}>
                                        {{ $ras->nama_ras }} ({{ $ras->jenisHewan->nama_jenis_hewan }})
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                <div class="alert alert-info" role="alert">
                    <i class="fas fa-info-circle"></i> 
                    <strong>Catatan:</strong> Field dengan tanda <span class="text-danger">*</span> wajib diisi.
                </div>

                <!-- Buttons -->
                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('admin.pet.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Auto-capitalize nama pet
    document.getElementById('nama').addEventListener('blur', function() {
        this.value = this.value.toLowerCase().replace(/\b\w/g, function(l) {
            return l.toUpperCase();
        });
    });

    // Auto-capitalize warna/tanda
    document.getElementById('warna_tanda').addEventListener('blur', function() {
        this.value = this.value.charAt(0).toUpperCase() + this.value.slice(1).toLowerCase();
    });
</script>
@endpush
@endsection