<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <!--begin::Brand Image-->
            <img
                src="{{ asset('assets/img/AdminLTELogo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">RSHP</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="navigation"
                aria-label="Main navigation"
                data-accordion="false"
                id="navigation"
            >
                @php
                    $roleId = session('user_role_id');
                @endphp

                {{-- ADMIN MENU --}}
                @if($roleId == 1)
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Master Data -->
                    <li class="nav-item {{ request()->is('admin/jenishewan*') || request()->is('admin/rashewan*') || request()->is('admin/kategori*') || request()->is('admin/kategoriklinis*') || request()->is('admin/kodetindakanterapi*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-box-seam-fill"></i>
                            <p>
                                Data Master
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.jenishewan.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.jenishewan.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Jenis Hewan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.rashewan.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.rashewan.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Ras Hewan</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kategori.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.kategori.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Kategori</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kategoriklinis.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.kategoriklinis.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Kategori Klinis</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.kodetindakanterapi.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.kodetindakanterapi.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Kode Tindakan Terapi</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Pet -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pet.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart-fill"></i>
                            <p>Data Pet</p>
                        </a>
                    </li>

                    <!-- Pemilik -->
                    <li class="nav-item">
                        <a href="{{ route('admin.pemilik.index') }}" 
                           class="nav-link {{ request()->routeIs('admin.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Data Pemilik</p>
                        </a>
                    </li>

                    <!-- User Management -->
                    <li class="nav-item {{ request()->is('admin/role*') || request()->is('admin/roleuser*') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon bi bi-shield-lock-fill"></i>
                            <p>
                                User Management
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ route('admin.role.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.role.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Role</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('admin.roleuser.index') }}" 
                                   class="nav-link {{ request()->routeIs('admin.roleuser.*') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Role User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-header">TRANSAKSI</li>

                    <li class="nav-item">
                        <a href="{{ route('admin.dokter.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>Data Dokter</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('admin.perawat.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-user-nurse"></i>
                            <p>Data Perawat</p>
                        </a>
                    </li>

                    <!-- ... menu lain ... -->
    
                    <!-- Divider -->
                    <li class="nav-header">AKUN</li>
                    
                    <!-- Profil Admin -->
                    <li class="nav-item">
                        <a href="{{ route('admin.profil') }}" 
                        class="nav-link {{ request()->routeIs('admin.profil*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>

                {{-- DOKTER MENU --}}
                @elseif($roleId == 2)
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Rekam Medis Management -->
                    <li class="nav-item {{ request()->is('dokter/rekammedis*') ? 'menu-open' : '' }}">
                        <a href="{{ url('/dokter/rekammedis') }}" class="nav-link {{ request()->is('dokter/rekammedis') || request()->is('dokter/rekammedis/create') || request()->is('dokter/rekammedis/*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-file-earmark-medical-fill"></i>
                            <p>
                                Rekam Medis
                                <i class="nav-arrow bi bi-chevron-right"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/dokter/rekammedis') }}" 
                                   class="nav-link {{ request()->is('dokter/rekammedis') || request()->is('dokter/rekammedis/create') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle-fill"></i>
                                    <p>Semua Rekam Medis</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Divider -->
                    <li class="nav-header">PROFIL & PENGATURAN</li>

                    <!-- Profil Dokter -->
                    <li class="nav-item">
                        <a href="{{ route('dokter.profil') }}" 
                           class="nav-link {{ request()->routeIs('dokter.profil*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>

                    {{-- PERAWAT MENU --}}
                    @elseif($roleId == 3)
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('perawat.dashboard') }}" 
                            class="nav-link {{ request()->routeIs('perawat.dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-speedometer"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Data Pasien (hewan) -->
                        <li class="nav-item">
                            <a href="{{ route('perawat.pasien.index') }}" 
                            class="nav-link {{ request()->routeIs('perawat.pasien.*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people-fill"></i>
                                <p>Data Pasien-Hewan</p>
                            </a>
                        </li>

                        <!-- Rekam Medis -->
                        <li class="nav-item {{ request()->is('perawat/rekammedis*') ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link">
                                <i class="nav-icon bi bi-file-earmark-medical-fill"></i>
                                <p>
                                    Rekam Medis
                                    <i class="nav-arrow bi bi-chevron-right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('perawat.rekammedis.index') }}" 
                                    class="nav-link {{ request()->routeIs('perawat.rekammedis.index') ? 'active' : '' }}">
                                        <i class="nav-icon bi bi-circle"></i>
                                        <p>Daftar Rekam Medis</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Profil Perawat -->
                        <li class="nav-header">AKUN</li>
                        <li class="nav-item">
                            <a href="{{ route('perawat.profil') }}" 
                            class="nav-link {{ request()->routeIs('perawat.profil*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-circle"></i>
                                <p>Profil Saya</p>
                            </a>
                        </li>

                {{-- RESEPSIONIS MENU --}}
                @elseif($roleId == 4)
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('resepsionis.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Pet -->
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pet.index') }}" 
                           class="nav-link {{ request()->routeIs('resepsionis.pet.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart-fill"></i>
                            <p>Pet</p>
                        </a>
                    </li>

                    <!-- Pemilik -->
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.pemilik.index') }}" 
                           class="nav-link {{ request()->routeIs('resepsionis.pemilik.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Pemilik</p>
                        </a>
                    </li>

                    <!-- Temu Dokter -->
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.temudokter.index') }}" 
                           class="nav-link {{ request()->routeIs('resepsionis.temudokter.*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-badge-fill"></i>
                            <p>Temu Dokter</p>
                        </a>
                    </li>

                    <!-- Profil Resepsionis -->
                    <li class="nav-header">AKUN</li>
                    <li class="nav-item">
                        <a href="{{ route('resepsionis.profil') }}" 
                        class="nav-link {{ request()->routeIs('resepsionis.profil*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>

                {{-- PEMILIK MENU --}}
                @elseif($roleId == 5)
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('pemilik.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Hewan Saya -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.pet') }}" 
                           class="nav-link {{ request()->routeIs('pemilik.pet') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart-fill"></i>
                            <p>Hewan Saya</p>
                        </a>
                    </li>

                        <!-- Jadwal Temu Dokter -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.temu-dokter') }}" 
                        class="nav-link {{ request()->routeIs('pemilik.temu-dokter') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-check"></i>
                            <p>Jadwal Temu Dokter</p>
                        </a>
                    </li>

                    <!-- Riwayat Pemeriksaan -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.riwayat') }}" 
                           class="nav-link {{ request()->routeIs('pemilik.riwayat') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clock-history"></i>
                            <p>Riwayat Pemeriksaan</p>
                        </a>
                    </li>

                    <!-- Divider AKUN -->
                    <li class="nav-header">AKUN</li>

                    <!-- Profil Pemilik - MENU BARU INI YANG DITAMBAHKAN -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.profil') }}" 
                           class="nav-link {{ request()->routeIs('pemilik.profil*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-circle"></i>
                            <p>Profil Saya</p>
                        </a>
                    </li>
                @endif

                {{-- LOGOUT - Untuk semua role --}}
                <li class="nav-item">
                    <a href="{{ route('logout') }}" 
                       class="nav-link"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="nav-icon bi bi-box-arrow-right text-danger"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</aside>