<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Struktur Organisasi - RSHP Universitas Airlangga</title>
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
          <li class="active"><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
          <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
          <li><a href="{{ route('kontak') }}">Kontak</a></li>
          <li><a href="{{ route('login') }}">Login</a></li>
      </ul>
  </nav>

  <main>
      <section id="struktur">
            <h2>Struktur Organisasi</h2>
            <table>
                <tr>
                    <th>Jabatan</th>
                    <th>Nama</th>
                </tr>
                <tr>
                    <td>Direktur</td>
                    <td>Dr,Ira Sari Yudaniayanti, M.P., drh.</td>
                </tr>
                <tr>
                    <td>Wakil Direktur 1</td>
                    <td>Dr. Nusdianto Triakoso, M.P., drh.</td>
                </tr>
                <tr>
                    <td>Wakil Direktur 2</td>
                    <td>Dr. Miyayu Soneta S., M.Vet., drh.</td>
                </tr>
            </table>
            <img src="{{ asset('asset/img/struktur.jpg') }}" alt="Gedung RSHP">
        </section>
  </main>

  <footer>
      &copy; 2025 RSHP Universitas Airlangga. All rights reserved.
  </footer>
</body>
</html>
