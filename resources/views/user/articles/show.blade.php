@extends('layouts.user')

@section('content')
<article class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('articles') }}">Artikel</a></li>
                        <li class="breadcrumb-item active">{{ $article->title }}</li>
                    </ol>
                </nav>

                <h1 class="display-5 fw-bold mb-3">{{ $article->title }}</h1>
                <div class="d-flex align-items-center mb-4 text-muted">
                    <span class="me-3"><i class="bi bi-calendar3 me-1"></i> {{ $article->created_at->format('d M Y') }}</span>
                    <span><i class="bi bi-eye me-1"></i> {{ $article->views }} views</span>
                </div>

                <img src="{{ $article->image ?? 'https://via.placeholder.com/1200x600' }}" class="img-fluid rounded-4 shadow-sm mb-5 w-100" alt="{{ $article->title }}">

                <div class="article-content fs-5 lh-lg text-navy">
                    {!! nl2br(e($article->content)) !!}
                </div>

                <hr class="my-5">

                <div class="d-flex justify-content-between align-items-center">
                    <div class="share-buttons">
                        <span class="fw-bold me-3">Bagikan:</span>
                        <a href="#" class="btn btn-light rounded-circle me-2"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="btn btn-light rounded-circle me-2"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="btn btn-light rounded-circle"><i class="bi bi-whatsapp"></i></a>
                    </div>
                    <a href="{{ route('articles') }}" class="btn btn-navy rounded-pill px-4">Kembali ke Artikel</a>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Related Articles -->
<section class="py-5 bg-light">
    <div class="container">
        <h4 class="fw-bold mb-4">Artikel Terkait</h4>
        <div class="row">
            @foreach($related as $rel)
            <div class="col-md-4 mb-4">
                <div class="card h-100 border-0 shadow-sm overflow-hidden">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">{{ $rel->title }}</h6>
                        <a href="{{ route('articles.show', $rel->slug) }}" class="text-primary text-decoration-none small">Baca <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
