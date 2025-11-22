@extends('layouts.main')

@section('title', 'Kontak RSHP Universitas Airlangga')

@section('content')
<section id="kontak">
    <h2>Kontak Kami</h2>
    <p>Silakan hubungi kami melalui informasi di bawah ini untuk pertanyaan, layanan, atau kerja sama.</p>

    <div class="contact-info">

        <table class="contact-table">
            <tr>
                <th>Alamat</th>
                <td>Jl. Mulyorejo Kampus C Universitas Airlangga, Surabaya, Jawa Timur</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>(031) 5993016</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>rshp@unair.ac.id</td>
            </tr>
            <tr>
                <th>Jam Operasional</th>
                <td>Senin - Jumat: 08.00 - 16.00 WIB</td>
            </tr>
        </table>

        <h3>Peta Lokasi</h3>

        <div class="map-container">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3952.5453420344627!2d112.79339817485932!3d-7.835938392213952!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7fa0d4dc88b9d%3A0x6b3b9e4f09f0e1f5!2sRSHP%20Universitas%20Airlangga!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid"
                width="100%"
                height="350"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>
@endsection
