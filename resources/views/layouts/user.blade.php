<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'TemanCuci - Panduan Cerdas Merawat Pakaian')</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        :root {
            --navy: #0a192f;
            --navy-light: #112240;
            --blue-light: #3498db;
            --blue-soft: #ebf5fb;
            --soft-gray: #f8f9fa;
            --white: #ffffff;
            --accent: #64ffda;
            --text-muted: #8892b0;
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--white);
            color: var(--navy);
            overflow-x: hidden;
        }
        .bg-navy { background-color: var(--navy) !important; }
        .bg-navy-light { background-color: var(--navy-light) !important; }
        .text-navy { color: var(--navy) !important; }
        .text-blue-light { color: var(--blue-light) !important; }
        
        /* Premium Buttons */
        .btn-primary { 
            background-color: var(--blue-light); 
            border-color: var(--blue-light);
            padding: 12px 30px;
            font-weight: 600;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border-radius: 12px;
        }
        .btn-primary:hover { 
            background-color: #2980b9; 
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(52, 152, 219, 0.3);
        }
        .btn-navy { 
            background-color: var(--navy); 
            color: white; 
            border: none;
            padding: 12px 30px;
            font-weight: 600;
            border-radius: 12px;
            transition: all 0.4s;
        }
        .btn-navy:hover { 
            background-color: var(--navy-light); 
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(10, 25, 47, 0.2);
        }
        
        /* Elegant Navbar */
        .navbar {
            background-color: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 30px rgba(0,0,0,0.03);
            padding: 20px 0;
            transition: all 0.3s;
        }
        .navbar.scrolled {
            padding: 12px 0;
        }
        .navbar-brand { 
            font-weight: 800; 
            font-size: 1.5rem;
            color: var(--navy); 
            letter-spacing: -0.5px;
        }
        .nav-link { 
            font-weight: 600; 
            color: var(--navy); 
            margin: 0 12px;
            font-size: 0.95rem;
            position: relative;
        }
        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -5px;
            left: 0;
            background-color: var(--blue-light);
            transition: width 0.3s;
        }
        .nav-link:hover::after,
        .nav-link.active::after { width: 100%; }
        .nav-link:hover,
        .nav-link.active { color: var(--blue-light); }
        
        /* Premium Cards */
        .card {
            border: none;
            border-radius: 24px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.04);
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
            background: var(--white);
        }
        .card:hover { 
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,0,0,0.08);
        }
        
        /* Section Styling */
        section { padding: 100px 0; }
        .section-title {
            font-weight: 800;
            font-size: 2.5rem;
            margin-bottom: 20px;
            letter-spacing: -1px;
        }

        /* Responsive Adjustments */
        @media (max-width: 991.98px) {
            .navbar { padding: 15px 0; }
            .navbar-collapse {
                background: white;
                margin-top: 15px;
                padding: 20px;
                border-radius: 20px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            }
            .nav-link {
                padding: 12px 0;
                margin: 0;
                text-align: center;
                border-bottom: 1px solid rgba(0,0,0,0.05);
            }
            .nav-link:last-child { border-bottom: none; }
            .nav-link::after { display: none; }
            .navbar-nav .ms-lg-4 {
                margin-left: 0 !important;
                margin-top: 15px;
                text-align: center;
            }
            section { padding: 60px 0; }
            .section-title { font-size: 2rem; }
            .footer { border-radius: 40px 40px 0 0; padding: 60px 0 30px; }
        }
        
        /* Footer */
        .footer {
            background-color: var(--navy);
            color: white;
            padding: 80px 0 40px;
            border-radius: 60px 60px 0 0;
        }
        .footer h5 { font-weight: 700; margin-bottom: 25px; }
        .footer-link {
            color: var(--text-muted);
            text-decoration: none;
            transition: 0.3s;
            display: block;
            margin-bottom: 12px;
        }
        .footer-link:hover { color: var(--blue-light); padding-left: 5px; }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 10px; }
        ::-webkit-scrollbar-track { background: var(--soft-gray); }
        ::-webkit-scrollbar-thumb { background: var(--navy); border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: var(--navy-light); }
    </style>
    @yield('styles')
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                <div class="bg-blue-light text-white rounded-3 d-flex align-items-center justify-content-center me-2" style="width: 40px; height: 40px;">
                    <i class="bi bi-water"></i>
                </div>
                <span>Teman<span class="text-blue-light">Cuci</span></span>
            </a>
            <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="bi bi-list fs-1"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ url('/') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('consultation') ? 'active' : '' }}" href="{{ route('consultation') }}">Cek Panduan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('symbols') ? 'active' : '' }}" href="{{ route('symbols') }}">Simbol Care</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('articles') ? 'active' : '' }}" href="{{ route('articles') }}">Artikel</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('guide') ? 'active' : '' }}" href="{{ route('guide') }}">Panduan</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang</a></li>
                    <li class="nav-item ms-lg-4">
                        <a class="btn btn-navy px-4 rounded-pill" href="{{ route('admin.login') }}">
                            <i class="bi bi-person-lock me-2"></i>Admin
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h4 class="text-white fw-800 mb-4">Teman<span class="text-blue-light">Cuci</span></h4>
                    <p style="color: var(--text-muted); line-height: 1.8;">Solusi cerdas berbasis Sistem Pendukung Keputusan untuk membantu Anda merawat pakaian dengan metode ilmiah yang tepat dan efisien.</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="btn btn-navy-light text-white me-2 rounded-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="btn btn-navy-light text-white me-2 rounded-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-navy-light text-white rounded-3"><i class="bi bi-twitter-x"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <h5>Layanan</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('consultation') }}" class="footer-link">Konsultasi</a></li>
                        <li><a href="{{ route('symbols') }}" class="footer-link">Simbol Perawatan</a></li>
                        <li><a href="{{ route('articles') }}" class="footer-link">Artikel Tips</a></li>
                        <li><a href="{{ route('guide') }}" class="footer-link">Panduan</a></li>
                    </ul>
                </div>
                <div class="col-lg-2">
                    <h5>Perusahaan</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="#" class="footer-link">Kebijakan Privasi</a></li>
                        <li><a href="#" class="footer-link">Syarat & Ketentuan</a></li>
                        <li><a href="mailto:temancucistaff@gmail.com?subject=Kontak%20TemanCuci" class="footer-link">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h5>Hubungi Kami</h5>
                    <p style="color: var(--text-muted);"><i class="bi bi-envelope-fill text-blue-light me-2"></i> <a href="mailto:temancucistaff@gmail.com?subject=Hubungi%20TemanCuci" class="footer-link d-inline mb-0">temancucistaff@gmail.com</a></p>
                    <p style="color: var(--text-muted);"><i class="bi bi-geo-alt-fill text-blue-light me-2"></i> Jakarta, Indonesia</p>
                </div>
            </div>
            <hr class="mt-5 border-secondary opacity-25">
            <div class="text-center mt-4">
                <p class="mb-0" style="color: var(--text-muted); font-size: 0.9rem;">
                    {{ \App\Models\AppSetting::where('key', 'footer_text')->first()?->value ?? '© 2026 TemanCuci. All rights reserved.' }}
                </p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            easing: 'ease-out-cubic'
        });

        window.addEventListener('scroll', function() {
            const nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('scrolled');
            } else {
                nav.classList.remove('scrolled');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
