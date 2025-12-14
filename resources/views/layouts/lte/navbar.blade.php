<style>
/* ===============================
   RSHP NAVBAR - MODERN AESTHETIC
   Color Palette:
   #8AAEE0 - Light Blue
   #B1C9EF - Lighter Blue
   #628ECB - Medium Blue
   #D5DEEF - Light Gray Blue
   #395886 - Dark Blue
   #F0F3FA - Very Light Blue
================================ */

.rshp-navbar {
    background: linear-gradient(135deg, #395886 0%, #628ECB 100%);
    border: none;
    box-shadow: 0 2px 20px rgba(57, 88, 134, 0.15);
    backdrop-filter: blur(10px);
    padding: 0.75rem 0;
}

.rshp-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 0 1rem;
}

.rshp-brand-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #8AAEE0 0%, #B1C9EF 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 4px 12px rgba(138, 174, 224, 0.3);
}

.rshp-brand-text {
    font-size: 1.3rem;
    font-weight: 700;
    color: white;
    letter-spacing: 0.5px;
}

.rshp-nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 8px;
    padding: 8px 16px !important;
    position: relative;
}

.rshp-nav-link:hover,
.rshp-nav-link:focus {
    color: white !important;
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-2px);
}

.rshp-nav-link i {
    font-size: 1.1rem;
}

/* Icon Button Style */
.rshp-icon-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease;
    position: relative;
}

.rshp-icon-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

/* Badge Style */
.rshp-badge {
    position: absolute;
    top: -4px;
    right: -4px;
    background: linear-gradient(135deg, #FF6B6B 0%, #FF8E8E 100%);
    color: white;
    font-size: 0.65rem;
    font-weight: 600;
    min-width: 18px;
    height: 18px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #395886;
    box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
}

/* User Profile Button */
.rshp-user-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 12px;
    padding: 6px 12px 6px 6px;
    transition: all 0.3s ease;
    color: white !important;
}

.rshp-user-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.rshp-user-avatar {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    background: linear-gradient(135deg, #8AAEE0 0%, #B1C9EF 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    box-shadow: 0 2px 8px rgba(138, 174, 224, 0.3);
}

.rshp-user-name {
    font-weight: 600;
    font-size: 0.9rem;
    max-width: 120px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Dropdown Menu */
.rshp-dropdown {
    background: white;
    border-radius: 16px;
    border: 1px solid #D5DEEF;
    padding: 8px;
    box-shadow: 0 8px 32px rgba(57, 88, 134, 0.15);
    min-width: 280px;
    margin-top: 8px;
}

.rshp-dropdown-header {
    padding: 12px 16px;
    border-bottom: 1px solid #D5DEEF;
    margin-bottom: 8px;
}

.rshp-dropdown-title {
    font-size: 0.85rem;
    font-weight: 600;
    color: #395886;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.rshp-dropdown .dropdown-item {
    padding: 12px 16px;
    border-radius: 10px;
    transition: all 0.2s ease;
    color: #395886;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 12px;
}

.rshp-dropdown .dropdown-item:hover {
    background: linear-gradient(135deg, #F0F3FA 0%, #E8EEF8 100%);
    color: #395886;
    transform: translateX(4px);
}

.rshp-dropdown .dropdown-item i {
    width: 20px;
    font-size: 1.1rem;
    color: #628ECB;
}

.dropdown-item-content {
    flex: 1;
}

.dropdown-item-title {
    font-size: 0.9rem;
    font-weight: 600;
    color: #395886;
    margin-bottom: 2px;
}

.dropdown-item-text {
    font-size: 0.8rem;
    color: #628ECB;
    margin: 0;
}

.dropdown-item-time {
    font-size: 0.75rem;
    color: #8AAEE0;
}

.dropdown-divider {
    border-color: #D5DEEF;
    margin: 8px 0;
}

.rshp-dropdown-footer {
    padding: 8px 16px;
    text-align: center;
    border-top: 1px solid #D5DEEF;
    margin-top: 8px;
}

.rshp-dropdown-footer a {
    color: #628ECB;
    font-weight: 600;
    font-size: 0.85rem;
    text-decoration: none;
    transition: all 0.2s ease;
}

.rshp-dropdown-footer a:hover {
    color: #395886;
}

/* Search Box */
.navbar-search-block {
    position: absolute;
    top: 100%;
    right: 0;
    left: 0;
    background: white;
    border-radius: 16px;
    margin: 8px 16px;
    box-shadow: 0 8px 32px rgba(57, 88, 134, 0.15);
    padding: 16px;
}

.navbar-search-block .form-control {
    border: 2px solid #D5DEEF;
    border-radius: 12px;
    padding: 12px 16px;
    transition: all 0.3s ease;
}

.navbar-search-block .form-control:focus {
    border-color: #628ECB;
    box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .rshp-brand-text {
        font-size: 1.1rem;
    }
    
    .rshp-user-name {
        display: none;
    }
    
    .rshp-dropdown {
        min-width: 260px;
    }
}

/* Sidebar Toggle Animation */
.nav-link[data-lte-toggle="sidebar"] i {
    transition: transform 0.3s ease;
}

.nav-link[data-lte-toggle="sidebar"]:hover i {
    transform: scale(1.1);
}
</style>

<nav class="app-header navbar navbar-expand rshp-navbar">
    <div class="container-fluid">

        {{-- Left Navbar --}}
        <ul class="navbar-nav">
            {{-- Sidebar Toggle --}}
            <li class="nav-item">
                <a class="nav-link rshp-nav-link" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            </li>

            {{-- Brand/Logo --}}
            <li class="nav-item d-none d-md-flex">
                <div class="rshp-brand">
                    <div class="rshp-brand-icon">
                        <i class="bi bi-heart-pulse-fill"></i>
                    </div>
                    <span class="rshp-brand-text">RSHP</span>
                </div>
            </li>
        </ul>

        {{-- Right Navbar --}}
        <ul class="navbar-nav ms-auto">
            
            {{-- Search Button --}}
            <li class="nav-item">
                <a class="nav-link rshp-nav-link rshp-icon-btn" data-widget="navbar-search" href="#" role="button">
                    <i class="bi bi-search"></i>
                </a>
            </li>

            {{-- Notifications Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link rshp-nav-link rshp-icon-btn" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-bell-fill"></i>
                    <span class="rshp-badge">5</span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end rshp-dropdown">
                    <div class="rshp-dropdown-header">
                        <span class="rshp-dropdown-title">Notifikasi</span>
                    </div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-calendar-check-fill"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Janji Temu Besok</div>
                            <p class="dropdown-item-text">Pemeriksaan rutin untuk Max</p>
                            <span class="dropdown-item-time">2 jam lalu</span>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-heart-fill"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Vaksinasi Selesai</div>
                            <p class="dropdown-item-text">Vaksinasi untuk Luna berhasil</p>
                            <span class="dropdown-item-time">5 jam lalu</span>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <div class="rshp-dropdown-footer">
                        <a href="#">Lihat Semua Notifikasi</a>
                    </div>
                </div>
            </li>

            {{-- Messages Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link rshp-nav-link rshp-icon-btn" data-bs-toggle="dropdown" href="#">
                    <i class="bi bi-chat-dots-fill"></i>
                    <span class="rshp-badge">3</span>
                </a>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end rshp-dropdown">
                    <div class="rshp-dropdown-header">
                        <span class="rshp-dropdown-title">Pesan</span>
                    </div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-person-circle"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Dr. Andi Wijaya</div>
                            <p class="dropdown-item-text">Hasil lab sudah keluar...</p>
                            <span class="dropdown-item-time">1 jam lalu</span>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="#" class="dropdown-item">
                        <i class="bi bi-person-circle"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Admin RSHP</div>
                            <p class="dropdown-item-text">Jadwal telah dikonfirmasi</p>
                            <span class="dropdown-item-time">3 jam lalu</span>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <div class="rshp-dropdown-footer">
                        <a href="#">Lihat Semua Pesan</a>
                    </div>
                </div>
            </li>

            {{-- User Profile Dropdown --}}
            <li class="nav-item dropdown">
                <a class="nav-link rshp-user-btn" data-bs-toggle="dropdown" href="#">
                    <div class="rshp-user-avatar">
                        {{ strtoupper(substr(Auth::user()->nama ?? 'U', 0, 1)) }}
                    </div>
                    <div class="rshp-user-name d-none d-md-block">
                        {{ Auth::user()->nama ?? 'User' }}
                    </div>
                    <i class="bi bi-chevron-down d-none d-md-block"></i>
                </a>

                <div class="dropdown-menu dropdown-menu-end rshp-dropdown">
                    <div class="rshp-dropdown-header">
                        <span class="rshp-dropdown-title">Akun Saya</span>
                    </div>

                    @php
                        $roleId = session('user_role_id');
                        $profilRoute = match($roleId) {
                            1 => 'admin.profil',
                            2 => 'dokter.profil',
                            3 => 'perawat.profil',
                            4 => 'resepsionis.profil',
                            5 => 'pemilik.profil',
                            default => '#'
                        };
                    @endphp

                    <a href="{{ route($profilRoute) }}" class="dropdown-item">
                        <i class="bi bi-person-fill"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title">Profil Saya</div>
                        </div>
                    </a>

                    <div class="dropdown-divider"></div>

                    <a href="{{ route('logout') }}" 
                       class="dropdown-item"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right text-danger"></i>
                        <div class="dropdown-item-content">
                            <div class="dropdown-item-title text-danger">Logout</div>
                        </div>
                    </a>
                </div>
            </li>

        </ul>

    </div>
</nav>

<!-- Logout Form -->
<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>