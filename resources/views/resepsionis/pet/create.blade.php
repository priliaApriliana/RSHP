@extends('layouts.lte.main')



@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('resepsionis.pet.index') }}">Pet</a></li>
    <li class="breadcrumb-item active">Tambah</li>
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
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-blue) !important;
        box-shadow: 0 0 0 0.2rem rgba(98, 142, 203, 0.25) !important;
    }
    
    .form-label {
        color: #395686;
        font-weight: 500;
        font-size: 0.9rem;
    }
    
    .form-control, .form-select {
        font-size: 0.9rem;
    }
</style>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-header" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none;">
                    <h5 class="mb-0"><i class="bi bi-heart-fill me-2"></i>Registrasi Pet</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show border-0" style="background-color: rgba(98, 142, 203, 0.1); color: #628ECB;">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-check-circle me-2"></i><strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show border-0">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <i class="bi bi-exclamation-circle me-2"></i><strong>Validasi Error!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('resepsionis.pet.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label"><i class="bi bi-heart me-2" style="color: #628ECB;"></i>Nama Pet</label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama pet" value="{{ old('nama') }}" required>
                            @error('nama')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label"><i class="bi bi-calendar-fill me-2" style="color: #628ECB;"></i>Tanggal Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}" required>
                            @error('tanggal_lahir')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="warna_tanda" class="form-label"><i class="bi bi-palette me-2" style="color: #628ECB;"></i>Warna / Tanda Khusus</label>
                            <input type="text" name="warna_tanda" id="warna_tanda" class="form-control" placeholder="Contoh: bintik putih di dahi" value="{{ old('warna_tanda') }}">
                            @error('warna_tanda')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label"><i class="bi bi-gender-ambiguous me-2" style="color: #628ECB;"></i>Jenis Kelamin</label>
                            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                                <option value="">-- Pilih --</option>
                                <option value="J" {{ old('jenis_kelamin') == 'J' ? 'selected' : '' }}>Jantan</option>
                                <option value="B" {{ old('jenis_kelamin') == 'B' ? 'selected' : '' }}>Betina</option>
                            </select>
                            @error('jenis_kelamin')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="idpemilik" class="form-label"><i class="bi bi-person-fill me-2" style="color: #628ECB;"></i>Pemilik</label>
                            <select name="idpemilik" id="idpemilik" class="form-select" required>
                                <option value="">-- Pilih Pemilik --</option>
                                @foreach ($pemilik as $p)
                                    <option value="{{ $p->idpemilik }}" {{ old('idpemilik') == $p->idpemilik ? 'selected' : '' }}>
                                        {{ $p->user->nama ?? 'Tanpa User' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idpemilik')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="idras_hewan" class="form-label"><i class="bi bi-collection me-2" style="color: #628ECB;"></i>Ras Hewan</label>
                            <select name="idras_hewan" id="idras_hewan" class="form-select" required>
                                <option value="">-- Pilih Ras --</option>
                                @foreach ($rasHewan as $r)
                                    <option value="{{ $r->idras_hewan }}"
                                            data-jenis="{{ $r->jenisHewan->nama_jenis_hewan ?? '-' }}"
                                            {{ old('idras_hewan') == $r->idras_hewan ? 'selected' : '' }}>
                                        {{ $r->nama_ras }}
                                    </option>
                                @endforeach
                            </select>
                            @error('idras_hewan')<span class="text-danger small">{{ $message }}</span>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">
                                <i class="bi bi-tags me-2" style="color:#628ECB;"></i>Jenis Hewan
                            </label>
                            <input type="text" 
                                id="jenis_hewan_display" 
                                class="form-control" 
                                placeholder="Otomatis terisi setelah pilih ras"
                                readonly>
                        </div>

                        <div class="d-flex gap-2 mt-3">
                            <button type="submit" class="btn btn-sm" style="background: linear-gradient(135deg, #628ECB 0%, #395686 100%); color: white; border: none; flex: 1;">
                                <i class="bi bi-save me-2"></i>Simpan Pet
                            </button>
                            <a href="{{ route('resepsionis.pet.index') }}" class="btn btn-sm btn-secondary" style="flex: 0.5;">
                                <i class="bi bi-x me-2"></i>Batal
                            </a>
                        </div>
                    </form>

                    <script>
                        document.getElementById('idras_hewan').addEventListener('change', function () {
                            const selected = this.options[this.selectedIndex];
                            document.getElementById('jenis_hewan_display').value =
                                selected.getAttribute('data-jenis') || '';
                        });
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
