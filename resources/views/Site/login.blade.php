<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login RSHP Universitas Airlangga</title>
    <link rel="stylesheet" href="{{ asset('assets/style/style.css') }}">
</head>
<body>

    <!-- Header -->
    <header>
        <img src="{{ asset('assets/img/LOGO_UNAIR-removebg-preview.png') }}" alt="Logo UNAIR">
        <h1>Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h1>
    </header>

    <!-- Navigasi -->
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
            <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
            <li><a href="{{ route('visi') }}">Visi Misi & Tujuan</a></li>
            <li><a href="{{ route('kontak') }}">Kontak</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>

    <!-- Form Login -->
    <main>
        <div class="login-box">
            <h2>Login RSHP</h2>

            @if(session('error'))
                <p style="color:red; text-align:center;">{{ session('error') }}</p>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <label>Username</label>
                <input type="text" name="username" placeholder="Masukkan username" required>

                <label>Password</label>
                <input type="password" name="password" placeholder="Masukkan password" required>

                <button type="submit">Login</button>
            </form>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2025 RSHP Universitas Airlangga. All rights reserved.
    </footer>

</body>
</html>
