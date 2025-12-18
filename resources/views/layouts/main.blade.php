<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RSHP Universitas Airlangga')</title>

    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
</head>

<body>

<header class="site-header">
    <div class="header-left">
        <img src="{{ asset('assets/img/LOGO_UNAIR-removebg-preview.png') }}" class="logo">
        <h1 class="site-title">Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h1>
    </div>
</header>

<nav class="main-nav">
    <ul>
        <li><a class="{{ request()->routeIs('home','site.home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
        <li><a class="{{ request()->routeIs('struktur') ? 'active' : '' }}" href="{{ route('struktur') }}">Struktur Organisasi</a></li>
        <li><a class="{{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan Umum</a></li>
        <li><a class="{{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a></li>

        @auth
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="logout-btn">
                        Logout ({{ Auth::user()->nama }})
                    </button>
                </form>
            </li>
        @else
            <li><a href="{{ route('login') }}">Login</a></li>
        @endauth
    </ul>
</nav>

<div class="content-wrapper">
    @yield('content')
</div>

<footer class="site-footer">
    &copy; 2025 RSHP Universitas Airlangga
</footer>

</body>
</html>
