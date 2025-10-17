<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Layanan Umum - RSHP Universitas Airlangga</title>
  <link rel="stylesheet" href="{{ asset('asset/style/style.css') }}">
</head>
<body>
  <header>
      <img src="{{ asset('asset/img/LOGO_UNAIR-removebg-preview.png') }}" alt="Logo UNAIR">
      <h1>Rumah Sakit Hewan Pendidikan - Universitas Airlangga</h1>
  </header>

  <nav>
      <ul>
          <li><a href="{{ route('home') }}">Home</a></li>
          <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
          <li class="active"><a href="{{ route('layanan') }}">Layanan Umum</a></li>
          <li><a href="{{ route('visi') }}">Visi Misi & Tujuan</a></li>
          <li><a href="{{ route('kontak') }}">Kontak</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
  </nav>

  <main>
    <section class="layanan-section">
      <h2>Layanan Umum</h2>

      <div class="layanan-item">
        <h3>Poliklinik</h3>
        <p>
          Poliklinik adalah layanan rawat jalan di mana pasien tidak menginap. Di sini kami melakukan observasi, diagnosis, pengobatan, rehabilitasi medik, serta layanan penunjang seperti:  
          sitologi, dermatologi, hematologi, radiologi, ultrasonografi, elektrokardiografi, dan bila perlu pemeriksaan lebih lanjut seperti kultur bakteri atau histopatologi.  
          Kami juga menyediakan layanan **rapid test** untuk penyakit hewan seperti panleukopenia, calicivirus, FIP, parvovirus, dan distemper.
        </p>
        <p>Layanan di Poliklinik meliputi:</p>
        <ul>
          <li>Rawat Jalan</li>
          <li>Vaksinasi</li>
          <li>Akupuntur</li>
          <li>Kemoterapi</li>
          <li>Fisioterapi</li>
          <li>Mandi Terapi</li>
        </ul>
      </div>

      <div class="layanan-item">
        <h3>Rawat Inap</h3>
        <p>
          Rawat inap diberikan kepada pasien dengan kondisi berat. Saat rawat inap, pasien dipantau intensif oleh tim medis. Klien wajib menandatangani formulir konsen setelah mendapatkan penjelasan tentang kondisi dan rencana terapi, serta estimasi biaya yang berlaku.
        </p>
      </div>

      <div class="layanan-item">
        <h3>Bedah</h3>
        <p>Kami menyediakan tindakan bedah berikut:</p>
        <ul>
          <li><strong>Minor:</strong> Jahit luka, kastrasi, othematoma, scaling-root planning, ekstraksi gigi</li>
          <li><strong>Mayor:</strong> Gastrotomi, entrotomi, enteroktomi, piometra, ovariohisterektomi, sectio caesar, fraktur, eksisi tumor, dan lain-lain</li>
        </ul>
      </div>

      <div class="layanan-item">
        <h3>Pemeriksaan</h3>
        <p>Layanan pemeriksaan penunjang meliputi:</p>
        <ul>
          <li>Pemeriksaan Sitologi</li>
          <li>Pemeriksaan Dermatologi</li>
          <li>Pemeriksaan Hematologi</li>
          <li>Pemeriksaan Radiografi</li>
          <li>Pemeriksaan Ultrasonografi</li>
        </ul>
      </div>

      <div class="layanan-image">
        <img src="{{ asset('asset/img/1.jpg') }}" alt="Layanan RSHP">
      </div>
    </section>
  </main>

  <footer>
      &copy; 2025 RSHP Universitas Airlangga. All rights reserved.
  </footer>
</body>
</html>
