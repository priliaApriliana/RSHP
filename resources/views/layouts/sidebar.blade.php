<div class="sidebar" id="sidebar">
    <div class="sidebar-header">
        <h3><i class="fas fa-hospital"></i> RSHP</h3>
    </div>

    <ul class="sidebar-menu">
        {{-- Cek role login user --}}
        @php
            $roleId = session('user_role_id');
        @endphp

        {{-- ADMIN --}}
        @if($roleId == 1)
            <li><a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ url('/admin/pet') }}" class="menu-link"><i class="fas fa-paw"></i> Pet</a></li>
            <li><a href="{{ url('/admin/pemilik') }}" class="menu-link"><i class="fas fa-users"></i> Pemilik</a></li>
            <li><a href="{{ url('/admin/user') }}" class="menu-link"><i class="fas fa-user-shield"></i> User</a></li>

        {{-- DOKTER --}}
        @elseif($roleId == 2)
            <li><a href="{{ route('dokter.dashboard') }}" class="menu-link"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ url('/dokter/rekammedis') }}" class="menu-link"><i class="fas fa-file-medical"></i> Rekam Medis</a></li>

        {{-- PERAWAT --}}
        @elseif($roleId == 3)
            <li><a href="{{ route('perawat.dashboard') }}" class="menu-link"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('perawat.rekammedis.index') }}" class="menu-link"><i class="fas fa-briefcase-medical"></i> Daftar Rekam medis</a></li>
            <li><a href="{{ route('perawat.rekammedis.create') }}" class="menu-link"><i class="fas fa-file-medical"></i> Form Rekam medis</a></li>

        {{-- RESEPSIONIS --}}
        @elseif($roleId == 4)
            <li><a href="{{ route('resepsionis.dashboard') }}" class="menu-link"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ url('/resepsionis/pet/create') }}" class="menu-link"><i class="fas fa-paw"></i> Registrasi Pet</a></li>
            <li><a href="{{ url('/resepsionis/pemilik') }}" class="menu-link"><i class="fas fa-users"></i> Registrasi Pemilik</a></li>
            <li><a href="{{ url('/resepsionis/temudokter') }}" class="menu-link"><i class="fas fa-user-md"></i> Daftar Temu Dokter</a></li>

        {{-- PEMILIK --}}
        @elseif($roleId == 5)
            <li><a href="{{ route('pemilik.dashboard') }}" class="menu-link"><i class="fas fa-home"></i> Dashboard</a></li>
            <li><a href="{{ url('/pemilik/pet') }}" class="menu-link"><i class="fas fa-paw"></i> Hewan Saya</a></li>
            <li><a href="{{ url('/pemilik/riwayat') }}" class="menu-link"><i class="fas fa-history"></i> Riwayat Pemeriksaan</a></li>
        @endif

        {{-- LOGOUT --}}
        <li>
            <a href="{{ route('logout') }}" class="menu-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</div>
