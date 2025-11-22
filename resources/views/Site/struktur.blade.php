@extends('layouts.main')

@section('title', 'Struktur Organisasi - RSHP Universitas Airlangga')

@section('content')

<section id="struktur">

    <h2>Struktur Organisasi RSHP Universitas Airlangga</h2>

    <p>Berikut adalah susunan organisasi Rumah Sakit Hewan Pendidikan Universitas Airlangga:</p>

    <table class="struktur-table">
        <tr>
            <th>Jabatan</th>
            <th>Nama</th>
        </tr>

        <tr>
            <td>Direktur</td>
            <td>Dr. Ira Sari Yudaniayanti, M.P., drh.</td>
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

    <div class="struktur-image">
        <img src="{{ asset('assets/img/struktur.jpg') }}" alt="Struktur Organisasi RSHP">
    </div>

</section>

@endsection
