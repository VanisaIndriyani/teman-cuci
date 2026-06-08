@extends('layouts.user')

@section('styles')
<style>
    .hero-section {
        padding: 180px 0 140px;
        background: linear-gradient(rgba(10, 25, 47, 0.8), rgba(10, 25, 47, 0.8)), url('{{ asset('img/bg.png') }}');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        color: white;
        border-radius: 0 0 80px 80px;
        position: relative;
        overflow: hidden;
    }
    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        background: url('https://www.transparenttextures.com/patterns/cubes.png');
        opacity: 0.05;
    }
    .hero-title {
        font-weight: 800;
        font-size: 4rem;
        line-height: 1.1;
        margin-bottom: 25px;
        letter-spacing: -2px;
    }
    .hero-subtitle {
        color: var(--text-muted);
        font-size: 1.25rem;
        margin-bottom: 40px;
        max-width: 600px;
    }
    
    .feature-card {
        padding: 50px 30px;
        border-radius: 32px;
        background: var(--white);
        border: 1px solid rgba(0,0,0,0.05);
        height: 100%;
        transition: all 0.4s;
    }
    .feature-card:hover {
        background: var(--blue-soft);
        border-color: var(--blue-light);
    }
    .feature-icon {
        width: 70px;
        height: 70px;
        background: var(--blue-soft);
        color: var(--blue-light);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 25px;
        transition: all 0.4s;
    }
    .feature-card:hover .feature-icon {
        background: var(--blue-light);
        color: var(--white);
        transform: rotate(-10deg);
    }

    .video-container {
        position: relative;
        border-radius: 40px;
        overflow: hidden;
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    .video-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(10, 25, 47, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: 0.4s;
    }
    .video-container:hover .video-overlay {
        background: rgba(10, 25, 47, 0.2);
    }

    .article-card {
        border-radius: 30px;
        overflow: hidden;
        border: none;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    .article-img-wrapper {
        position: relative;
        overflow: hidden;
        height: 240px;
    }
    .article-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: 0.6s;
    }
    .article-card:hover .article-img-wrapper img {
        transform: scale(1.1);
    }
    .article-badge {
        position: absolute;
        top: 20px;
        left: 20px;
        z-index: 10;
    }
    .article-badge.badge {
        border: 1px solid rgba(10, 25, 47, 0.12);
        backdrop-filter: blur(8px);
    }
    .badge-cat-basic {
        background: rgba(255, 255, 255, 0.92) !important;
        color: var(--navy) !important;
    }
    .badge-cat-special {
        background: var(--blue-light) !important;
        color: #ffffff !important;
        border-color: rgba(52, 152, 219, 0.35) !important;
    }
    .badge-cat-tips {
        background: var(--navy) !important;
        color: #ffffff !important;
        border-color: rgba(10, 25, 47, 0.35) !important;
    }

    /* Responsive Hero */
    @media (max-width: 991.98px) {
        .hero-section {
            padding: 100px 0 60px;
            border-radius: 0 0 40px 40px;
            text-align: center;
        }
        .hero-title {
            font-size: 2.5rem;
            letter-spacing: -1px;
        }
        .hero-subtitle {
            font-size: 1.1rem;
            margin: 0 auto 30px;
        }
        .hero-section .d-flex {
            justify-content: center;
            flex-direction: column;
            gap: 15px !important;
        }
        .hero-section .btn {
            width: 100%;
            padding: 15px;
        }
        .video-container {
            border-radius: 20px;
        }
        .section-title {
            font-size: 1.8rem;
        }
    }

    .video-tutorial-section {
        background: linear-gradient(135deg, rgba(235, 245, 251, 0.9), rgba(255, 255, 255, 1));
        border-radius: 60px;
        border: 1px solid rgba(10, 25, 47, 0.06);
    }
    .video-feature {
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid rgba(10, 25, 47, 0.06);
        border-radius: 18px;
        padding: 12px 14px;
    }
    @media (max-width: 991.98px) {
        .video-tutorial-section { border-radius: 30px; }
    }
</style>
@endsection

@section('content')
<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center" data-aos="fade-up">
              
                <h1 class="hero-title">Panduan Cerdas<br><span class="text-blue-light">Merawat Pakaianmu</span></h1>
                <p class="hero-subtitle mx-auto">Teknologi Rule-Based Filtering & SAW untuk hasil pencucian maksimal. Awetkan pakaian kesayangan Anda dengan panduan ilmiah.</p>
                <div class="d-flex gap-3 justify-content-center">
                    <a href="{{ route('consultation') }}" class="btn btn-primary btn-lg rounded-pill shadow-lg px-5">Mulai Konsultasi <i class="bi bi-arrow-right ms-2"></i></a>
                    <a href="#cara-kerja" class="btn btn-outline-light btn-lg rounded-pill px-5">Pelajari <i class="bi bi-play-circle ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it Works -->
<section id="cara-kerja" class="bg-soft-gray">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h6 class="text-blue-light fw-bold text-uppercase">Metode Kami</h6>
            <h2 class="section-title">3 Langkah Mudah</h2>
            <p class="text-muted mx-auto" style="max-width: 500px;">Hanya butuh beberapa detik untuk mendapatkan rekomendasi pencucian terbaik dari sistem pakar kami.</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-ui-checks"></i>
                    </div>
                    <h4 class="fw-bold">Pilih Karakteristik</h4>
                    <p class="text-muted mb-0">Masukkan detail kain, warna, motif, dan tingkat kekotoran pakaian Anda ke dalam sistem.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-cpu"></i>
                    </div>
                    <h4 class="fw-bold">Analisis Cerdas</h4>
                    <p class="text-muted mb-0">Sistem melakukan filtering 40 aturan pakar (RBF) dan perangkingan bobot (SAW) secara instan.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="bi bi-stars"></i>
                    </div>
                    <h4 class="fw-bold">Dapatkan Hasil</h4>
                    <p class="text-muted mb-0">Terima panduan lengkap: metode terbaik, langkah pencucian, deterjen, hingga tips perawatan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Video Tutorial -->
<section class="video-tutorial-section">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6" data-aos="fade-right">
                <h6 class="text-blue-light fw-bold text-uppercase">Video Panduan</h6>
                <h2 class="section-title">Edukasi Perawatan<br>Pakaian Berkualitas</h2>
                <p class="text-muted mb-4 fs-5">Tonton video tutorial kami untuk memahami cara kerja aplikasi dan tips dasar mencuci yang sering diabaikan.</p>
               
               
              
            </div>
            <div class="col-lg-6" data-aos="fade-left">
                <div class="video-container">
                    <div class="ratio ratio-16x9">
                        <iframe src="{{ $videoUrl ?? 'https://www.youtube.com/embed/Kz6EAn0X29c' }}" title="TemanCuci Video Guide" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="bg-soft-gray">
    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-5" data-aos="fade-up">
            <div>
                <h6 class="text-blue-light fw-bold text-uppercase">Wawasan Baru</h6>
                <h2 class="section-title mb-0">Artikel & Tips Terbaru</h2>
            </div>
            <a href="{{ route('articles') }}" class="btn btn-navy rounded-pill px-4">Lihat Semua <i class="bi bi-grid ms-2"></i></a>
        </div>
        <div class="row g-4">
            @foreach($articles as $article)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="article-card card h-100">
                    <div class="article-img-wrapper">
                        @if($article->categories->first())
                        @php
                            $catSlug = $article->categories->first()->slug ?? null;
                            $badgeClass = match ($catSlug) {
                                'perawatan-khusus' => 'badge-cat-special',
                                'tips-trik' => 'badge-cat-tips',
                                default => 'badge-cat-basic',
                            };
                        @endphp
                        <span class="badge article-badge shadow-sm rounded-pill px-3 py-2 {{ $badgeClass }}">
                            {{ $article->categories->first()->name }}
                        </span>
                        @endif
                        @php
                            $thumbnailUrl = $article->thumbnail
                                ? (\Illuminate\Support\Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset(ltrim($article->thumbnail, '/')))
                                : 'https://via.placeholder.com/600x400';
                        @endphp
                        <img src="{{ $thumbnailUrl }}" alt="{{ $article->title }}">
                    </div>
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3 text-muted small">
                            <i class="bi bi-calendar3 me-2"></i> {{ $article->created_at->format('d M Y') }}
                            <span class="mx-2">•</span>
                            <i class="bi bi-eye me-2"></i> {{ $article->views }} Views
                        </div>
                        <h5 class="fw-bold mb-3">{{ $article->title }}</h5>
                        <p class="text-muted small mb-4">{{ Str::limit(strip_tags($article->content), 100) }}</p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-link text-blue-light p-0 text-decoration-none fw-bold">
                            Baca Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
