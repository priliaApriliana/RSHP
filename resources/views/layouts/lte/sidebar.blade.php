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
                                Master Data
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
                                    <p>User</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                {{-- DOKTER MENU --}}
                @elseif($roleId == 2)
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ route('dokter.dashboard') }}" 
                           class="nav-link {{ request()->routeIs('dokter.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-speedometer"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    <!-- Rekam Medis -->
                    <li class="nav-item">
                        <a href="{{ url('/dokter/rekammedis') }}" 
                           class="nav-link {{ request()->is('dokter/rekammedis*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-file-medical-fill"></i>
                            <p>Rekam Medis</p>
                        </a>
                    </li>

                    <!-- Jadwal -->
                    <li class="nav-item">
                        <a href="{{ url('/dokter/jadwal') }}" 
                           class="nav-link {{ request()->is('dokter/jadwal*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-check-fill"></i>
                            <p>Jadwal Praktik</p>
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
                            <li class="nav-item">
                                <a href="{{ route('perawat.rekammedis.create') }}" 
                                   class="nav-link {{ request()->routeIs('perawat.rekammedis.create') ? 'active' : '' }}">
                                    <i class="nav-icon bi bi-circle"></i>
                                    <p>Form Rekam Medis</p>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Jadwal -->
                    <li class="nav-item">
                        <a href="{{ route('perawat.jadwal') }}" 
                           class="nav-link {{ request()->routeIs('perawat.jadwal') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-calendar-event-fill"></i>
                            <p>Jadwal</p>
                        </a>
                    </li>

                    <!-- Pasien -->
                    <li class="nav-item">
                        <a href="{{ route('perawat.pasien') }}" 
                           class="nav-link {{ request()->routeIs('perawat.pasien') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-fill"></i>
                            <p>Data Pasien</p>
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

                    <!-- Registrasi Pet -->
                    <li class="nav-item">
                        <a href="{{ url('/resepsionis/pet/create') }}" 
                           class="nav-link {{ request()->is('resepsionis/pet*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-heart-fill"></i>
                            <p>Registrasi Pet</p>
                        </a>
                    </li>

                    <!-- Registrasi Pemilik -->
                    <li class="nav-item">
                        <a href="{{ url('/resepsionis/pemilik') }}" 
                           class="nav-link {{ request()->is('resepsionis/pemilik*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-people-fill"></i>
                            <p>Registrasi Pemilik</p>
                        </a>
                    </li>

                    <!-- Temu Dokter -->
                    <li class="nav-item">
                        <a href="{{ url('/resepsionis/temudokter') }}" 
                           class="nav-link {{ request()->is('resepsionis/temudokter*') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-person-badge-fill"></i>
                            <p>Daftar Temu Dokter</p>
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

                    <!-- Riwayat Pemeriksaan -->
                    <li class="nav-item">
                        <a href="{{ route('pemilik.riwayat') }}" 
                           class="nav-link {{ request()->routeIs('pemilik.riwayat') ? 'active' : '' }}">
                            <i class="nav-icon bi bi-clock-history"></i>
                            <p>Riwayat Pemeriksaan</p>
                        </a>
                    </li>
                @endif

                {{-- LOGOUT - Untuk semua role --}}
                <li class="nav-header">AKUN</li>
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