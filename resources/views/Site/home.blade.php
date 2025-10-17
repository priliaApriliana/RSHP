<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSHP Universitas Airlangga</title>
    <link rel="stylesheet" href="{{ asset('asset/style/style.css') }}">
</head>
<body>

    <!-- Header -->
    <header>
        <img src="{{ asset('asset/img/LOGO_UNAIR-removebg-preview.png') }}" alt="Logo UNAIR">
        <h1>Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h1>
    </header>

    <!-- Navigasi -->
    <nav>
        <ul>
            <li class="active"><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
            <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
            <li><a href="{{ route('kontak') }}">Kontak</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>

    <!-- Home -->
    <main>
        <section id="home">
            <h2>Selamat Datang di RSHP UNAIR</h2>
            <p>Rumah Sakit Hewan Pendidikan (RSHP) Universitas Airlangga adalah pusat layanan kesehatan hewan modern yang juga menjadi pusat pembelajaran bagi mahasiswa kedokteran hewan.</p>
            
            <div class="home-video">
              <iframe width="100%" height="315"
                src="https://www.youtube.com/embed/rCfvZPECZvE"
                title="Video RSHP Unair"
                frameborder="0"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
              </iframe>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        &copy; 2025 RSHP Universitas Airlangga. All rights reserved.
    </footer>

</body>
</html>
