@extends('layouts.user')

@section('styles')
<style>
    .page-header {
        background: radial-gradient(circle at top left, var(--navy-light), var(--navy));
        padding: 100px 0;
        color: white;
        border-radius: 0 0 60px 60px;
        margin-bottom: 60px;
    }
    .article-main-card {
        border-radius: 40px;
        overflow: hidden;
        border: none;
        box-shadow: 0 30px 60px rgba(0,0,0,0.05);
        transition: 0.4s;
    }
    .article-main-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 40px 80px rgba(0,0,0,0.1);
    }
    .category-sidebar {
        position: sticky;
        top: 120px;
    }
    .cat-item {
        padding: 15px 25px;
        border-radius: 15px;
        background: var(--soft-gray);
        color: var(--navy);
        font-weight: 700;
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 12px;
        transition: 0.3s;
    }
    .cat-item:hover, .cat-item.active {
        background: var(--blue-light);
        color: white;
    }
    .search-box {
        background: var(--soft-gray);
        border-radius: 20px;
        padding: 20px;
        border: none;
        width: 100%;
        font-weight: 600;
    }
</style>
@endsection

@section('content')
<div class="page-header text-center">
    <div class="container" data-aos="fade-down">
        <h6 class="text-blue-light fw-bold text-uppercase">Wawasan Terkini</h6>
        <h1 class="display-4 fw-800">Artikel & Tips Perawatan</h1>
        <p class="text-white-50 mx-auto mt-3" style="max-width: 600px;">Kumpulan panduan mendalam untuk membantu Anda merawat setiap helai pakaian dengan benar.</p>
    </div>
</div>

<section class="pt-0">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                @foreach($articles as $article)
                <div class="article-main-card card mb-5" data-aos="fade-up">
                    <div class="row g-0">
                        <div class="col-md-5">
                            @php
                                $thumbnailUrl = $article->thumbnail
                                    ? (\Illuminate\Support\Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset(ltrim($article->thumbnail, '/')))
                                    : 'https://via.placeholder.com/600x400';
                            @endphp
                            <img src="{{ $thumbnailUrl }}" class="img-fluid h-100 w-100" style="object-fit: cover; min-height: 250px;" alt="{{ $article->title }}">
                        </div>
                        <div class="col-md-7">
                            <div class="card-body p-4 p-lg-5">
                                <div class="d-flex align-items-center mb-3">
                                    @foreach($article->categories as $cat)
                                    @php
                                        $badgeClass = match ($cat->slug ?? null) {
                                            'perawatan-khusus' => 'bg-blue-light text-white',
                                            'tips-trik' => 'bg-navy text-white',
                                            default => 'bg-blue-soft text-blue-light',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill px-3 py-2 me-2">{{ $cat->name }}</span>
                                    @endforeach
                                    <span class="text-muted small ms-auto"><i class="bi bi-calendar3 me-1"></i> {{ $article->created_at->format('M d, Y') }}</span>
                                </div>
                                <h3 class="fw-800 text-navy mb-3">{{ $article->title }}</h3>
                                <p class="text-muted mb-4">{{ Str::limit(strip_tags($article->content), 150) }}</p>
                                <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-navy rounded-pill px-4">Baca Lengkap <i class="bi bi-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                
                <!-- Pagination placeholder -->
                <div class="d-flex justify-content-center mt-5">
                    {{ $articles->links() }}
                </div>
            </div>

            <div class="col-lg-4">
                <div class="category-sidebar" data-aos="fade-left">
                    <div class="mb-5">
                        <h5 class="fw-800 mb-4">Cari Artikel</h5>
                        <div class="position-relative">
                            <input type="text" class="search-box" placeholder="Ketik kata kunci...">
                            <i class="bi bi-search position-absolute top-50 end-0 translate-middle-y me-4 text-muted"></i>
                        </div>
                    </div>

                    <div class="mb-5">
                        <h5 class="fw-800 mb-4">Kategori</h5>
                        <a href="{{ route('articles') }}" class="cat-item {{ !request('category') ? 'active' : '' }}">
                            <span>Semua Kategori</span>
                            <span class="badge bg-white text-navy rounded-pill">{{ \App\Models\Article::count() }}</span>
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('articles', ['category' => $cat->slug]) }}" class="cat-item {{ request('category') == $cat->slug ? 'active' : '' }}">
                            <span>{{ $cat->name }}</span>
                            <span class="badge bg-white text-navy rounded-pill">{{ $cat->articles_count ?? 0 }}</span>
                        </a>
                        @endforeach
                    </div>

                    <div class="p-5 bg-navy text-white rounded-4 text-center">
                        <i class="bi bi-envelope-paper fs-1 text-blue-light mb-3"></i>
                        <h5 class="fw-bold mb-3">Berlangganan Tips</h5>
                        <p class="text-white-50 small mb-4">Dapatkan tips perawatan eksklusif langsung di email Anda setiap minggu.</p>
                        <div class="input-group">
                            <input type="email" class="form-control border-0" placeholder="Email Anda" style="border-radius: 12px 0 0 12px;">
                            <button class="btn btn-primary" style="border-radius: 0 12px 12px 0;"><i class="bi bi-send"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
