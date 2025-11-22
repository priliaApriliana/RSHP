@extends('layouts.main')

@section('title', 'Layanan Umum - RSHP Universitas Airlangga')

@section('content')

<section class="layanan-section">
    <h2>Layanan Umum</h2>

    {{-- Poliklinik --}}
    <div class="layanan-item">
        <h3>Poliklinik</h3>
        <p>
            Poliklinik adalah layanan rawat jalan tempat dilakukan observasi, diagnosis, pengobatan, 
            serta rehabilitasi medik. Layanan penunjang seperti sitologi, dermatologi, hematologi, 
            radiologi, ultrasonografi, elektrokardiografi, hingga pemeriksaan lanjutan seperti 
            kultur bakteri dan histopatologi tersedia di sini.
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

    {{-- Rawat Inap --}}
    <div class="layanan-item">
        <h3>Rawat Inap</h3>
        <p>
            Rawat inap diberikan untuk pasien dengan kondisi berat yang memerlukan pemantauan intensif.
            Klien wajib menandatangani formulir konsen setelah mendapatkan penjelasan terkait kondisi, 
            rencana terapi, dan estimasi biaya.
        </p>
    </div>

    {{-- Bedah --}}
    <div class="layanan-item">
        <h3>Bedah</h3>
        <p>Kami menyediakan tindakan bedah sebagai berikut:</p>

        <ul>
            <li><strong>Minor:</strong> Jahit luka, kastrasi, othematoma, scaling-root planning, ekstraksi gigi</li>
            <li><strong>Mayor:</strong> Gastrotomi, entrotomi, enteroktomi, piometra, 
                ovariohisterektomi, sectio caesar, fraktur, eksisi tumor, dan lainnya</li>
        </ul>
    </div>

    {{-- Pemeriksaan --}}
    <div class="layanan-item">
        <h3>Pemeriksaan Penunjang</h3>
        <p>Layanan pemeriksaan penunjang meliputi:</p>

        <ul>
            <li>Pemeriksaan Sitologi</li>
            <li>Pemeriksaan Dermatologi</li>
            <li>Pemeriksaan Hematologi</li>
            <li>Pemeriksaan Radiografi</li>
            <li>Pemeriksaan Ultrasonografi</li>
        </ul>
    </div>

    {{-- Gambar --}}
    <div class="layanan-image">
        <img src="{{ asset('assets/img/1.jpg') }}" alt="Layanan RSHP">
    </div>
</section>

@endsection
