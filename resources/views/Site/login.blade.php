<!-- pakai template layouts -->
@extends('layouts.app') 

@section('title', 'Login RSHP Universitas Airlangga')

<!-- Isi konten halaman ini akan dimasukkan ke dalam area @yield('content') yang ada di layout utama -->
@section('content')
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh ;">
    <div class="card shadow-lg border-0 rounded-4 p-4" style="widht: 420px;">
        <h2 class="text-center fw-bold mb-4 text-primary">Login RSHP</h2>

        @if(session('error'))
            <p class="text-danger text-center fw-semibold">{{ session('error') }}</p>
        @endif

        <form action="{{ route('login.process')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="username" class="form-label fw-semibold">Username</label>
                <input type="text" name="username" id="username" class="form-control rounded-3" 
                       placeholder="Masukkan username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">Password</label>
                <input type="password" name="password" id="password" class="form-control rounded-3" 
                       placeholder="Masukkan password" required>
            </div>

            <button type="submit" class="btn btn-primary w-100 fw-semibold py-2 mt-2">Login</button>
        </form>

        <div class="text-center mt-4">
            <small class="text-muted">
                &copy; 2025 RSHP Universitas Airlangga. All rights reserved.
            </small>
        </div>
    </div>
</div>
@endsection
