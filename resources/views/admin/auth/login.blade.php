<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - TemanCuci</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background: linear-gradient(135deg, #0a192f 0%, #112240 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0a192f;
        }
        .login-card {
            width: 100%;
            max-width: 450px;
            background: white;
            border-radius: 30px;
            padding: 50px;
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.1);
        }
        .form-control:focus {
            box-shadow: none;
            border-color: #3498db;
        }
        .input-group-text {
            border-radius: 12px 0 0 12px !important;
        }
        .form-control {
            border-radius: 0 12px 12px 0 !important;
        }
        .btn-toggle-pwd {
            border-radius: 0 12px 12px 0 !important;
            border: none;
            background: #f8f9fa;
        }
        .input-group > .form-control:not(:first-child):not(:last-child) {
            border-radius: 0 !important;
        }
    </style>
</head>
<body>

    <div class="login-card">
        <div class="text-center mb-5">
            <div class="bg-primary text-white rounded-4 d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; font-size: 2rem;">
                <i class="bi bi-water"></i>
            </div>
            <h2 class="fw-800 text-navy mb-1">Teman<span class="text-primary">Cuci</span></h2>
            <p class="text-muted">Selamat datang kembali, Admin!</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger border-0 rounded-4 mb-4">
                <ul class="mb-0 small">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.login') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="form-label fw-bold small text-uppercase opacity-75">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-envelope text-muted"></i></span>
                    <input type="email" name="email" class="form-control bg-light border-0 py-3" placeholder="admin@temancuci.com" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-4">
                <label class="form-label fw-bold small text-uppercase opacity-75">Password</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-0"><i class="bi bi-lock text-muted"></i></span>
                    <input type="password" name="password" id="password" class="form-control bg-light border-0 py-3" placeholder="••••••••" required>
                    <button class="btn btn-light border-0 btn-toggle-pwd" type="button" onclick="togglePassword()">
                        <i class="bi bi-eye text-muted" id="toggleIcon"></i>
                    </button>
                </div>
            </div>
            <div class="mb-4 d-flex justify-content-between align-items-center">
                <div class="form-check">
                    <input type="checkbox" name="remember" class="form-check-input" id="remember">
                    <label class="form-check-label small" for="remember">Ingat saya</label>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold py-3 shadow-lg">Masuk Dashboard <i class="bi bi-arrow-right ms-2"></i></button>
            </div>
        </form>
        
        <div class="text-center mt-5">
            <a href="{{ route('home') }}" class="text-decoration-none text-muted small hover-primary"><i class="bi bi-house-door me-1"></i> Kembali ke Beranda</a>
        </div>
    </div>

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
