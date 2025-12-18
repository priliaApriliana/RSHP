<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - RSHP Universitas Airlangga</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            background: linear-gradient(135deg, #F0F3FA 0%, #D5DEEF 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .login-container {
            width: 100%;
            max-width: 460px;
        }
        
        .login-card {
            background: #FFFFFF;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(57, 88, 134, 0.15);
            overflow: hidden;
            border: 1px solid #D5DEEF;
        }
        
        .logo-section {
            background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
            padding: 35px 20px 45px;
            text-align: center;
            position: relative;
        }
        
        .logo-circle {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #8AAEE0 0%, #B1C9EF 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border: 4px solid rgba(255, 255, 255, 0.3);
        }
        
        .logo-text {
            color: #FFFFFF;
            font-size: 30px;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        
        .login-title {
            color: #FFFFFF;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        
        .login-subtitle {
            color: rgba(255, 255, 255, 0.95);
            font-size: 13px;
        }
        
        .form-section {
            padding: 40px 35px;
        }
        
        .form-label {
            color: #395886;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
            display: block;
        }
        
        .password-wrapper {
            position: relative;
        }
        
        .form-control {
            border: 2px solid #D5DEEF;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background-color: #F0F3FA;
            width: 100%;
        }
        
        .form-control.with-icon {
            padding-right: 45px;
        }
        
        .form-control:focus {
            border-color: #628ECB;
            box-shadow: 0 0 0 4px rgba(98, 142, 203, 0.1);
            background-color: #FFFFFF;
            outline: none;
        }
        
        .form-control::placeholder {
            color: #8AAEE0;
        }
        
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            color: #628ECB;
            font-size: 18px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .password-toggle:hover {
            color: #395886;
            transform: translateY(-50%) scale(1.1);
        }
        
        .password-toggle:active {
            transform: translateY(-50%) scale(0.95);
        }
        
        .form-check {
            margin: 20px 0;
        }
        
        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 2px;
            border: 2px solid #D5DEEF;
            cursor: pointer;
        }
        
        .form-check-input:checked {
            background-color: #628ECB;
            border-color: #628ECB;
        }
        
        .form-check-label {
            color: #395886;
            font-size: 14px;
            margin-left: 8px;
            cursor: pointer;
        }
        
        .btn-login {
            background: linear-gradient(135deg, #628ECB 0%, #395886 100%);
            border: none;
            border-radius: 12px;
            color: #FFFFFF;
            font-weight: 600;
            font-size: 16px;
            padding: 14px;
            width: 100%;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 10px;
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(57, 88, 134, 0.3);
            background: linear-gradient(135deg, #395886 0%, #628ECB 100%);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            text-align: center;
            margin-top: 20px;
        }
        
        .forgot-password a {
            color: #628ECB;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        
        .forgot-password a:hover {
            color: #395886;
            text-decoration: underline;
        }
        
        .invalid-feedback {
            color: #dc3545;
            font-size: 13px;
            margin-top: 6px;
            display: block;
        }
        
        .is-invalid {
            border-color: #dc3545 !important;
            background-color: #fff5f5 !important;
        }
        
        .mb-3 {
            margin-bottom: 20px;
        }
        
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-danger {
            background-color: #fff5f5;
            border: 1px solid #ffcdd2;
            color: #c62828;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .form-section {
                padding: 30px 25px;
            }
            
            .logo-section {
                padding: 30px 20px 50px;
            }
            
            .logo-circle {
                width: 80px;
                height: 80px;
            }
            
            .logo-text {
                font-size: 30px;
            }
            
            .login-title {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo-circle">
                    <span class="logo-text">RS</span>
                </div>
                <h1 class="login-title">Selamat Datang</h1>
                <p class="login-subtitle">RSHP Universitas Airlangga</p>
            </div>

            <!-- Form Section -->
            <div class="form-section">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input id="email" 
                               type="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               name="email" 
                               value="{{ old('email') }}" 
                               placeholder="Masukkan email Anda"
                               required 
                               autocomplete="email" 
                               autofocus>

                        @error('email')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="password-wrapper">
                            <input id="password" 
                                   type="password" 
                                   class="form-control with-icon @error('password') is-invalid @enderror" 
                                   name="password" 
                                   placeholder="Masukkan password Anda"
                                   required 
                                   autocomplete="current-password">
                            
                            <button type="button" 
                                    class="password-toggle" 
                                    onclick="togglePassword()"
                                    aria-label="Toggle password visibility">
                                <i class="bi bi-eye" id="toggleIcon"></i>
                            </button>
                        </div>

                        @error('password')
                            <span class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="form-check">
                        <input class="form-check-input" 
                               type="checkbox" 
                               name="remember" 
                               id="remember" 
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            Remember Me
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-login">
                        Masuk
                    </button>

                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                        <div class="forgot-password">
                            <a href="{{ route('password.request') }}">
                                Lupa Password?
                            </a>
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Password Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('toggleIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('bi-eye');
                toggleIcon.classList.add('bi-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('bi-eye-slash');
                toggleIcon.classList.add('bi-eye');
            }
        }
    </script>
</body>
</html>