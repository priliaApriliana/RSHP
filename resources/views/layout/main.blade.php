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
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('struktur') }}">Struktur Organisasi</a></li>
            <li><a href="{{ route('layanan') }}">Layanan Umum</a></li>
            <li><a href="{{ route('visi') }}">Visi Misi & Tujuan</a></li>
            <li><a href="{{ route('kontak') }}">Kontak</a></li>
            <li><a href="{{ route('login') }}">Login</a></li>
        </ul>
    </nav>