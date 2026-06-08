@extends('layouts.user')

@section('styles')
<style>
    .page-header {
        background: var(--navy);
        padding: 100px 0;
        color: white;
        border-radius: 0 0 60px 60px;
        margin-bottom: 60px;
    }
    .nav-pills-premium {
        background: var(--soft-gray);
        padding: 10px;
        border-radius: 20px;
        display: inline-flex;
    }
    .nav-pills-premium .nav-link {
        border-radius: 15px;
        padding: 12px 25px;
        color: var(--navy);
        font-weight: 700;
        transition: 0.3s;
        border: none;
    }
    .nav-pills-premium .nav-link.active {
        background: var(--white);
        color: var(--blue-light);
        box-shadow: 0 10px 20px rgba(0,0,0,0.05);
    }
    .symbol-card {
        border-radius: 30px;
        padding: 30px;
        text-align: center;
        height: 100%;
        border: 1px solid rgba(0,0,0,0.05);
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
    }
    .symbol-card:hover {
        background: var(--blue-soft);
        border-color: var(--blue-light);
        transform: translateY(-10px);
    }
    .symbol-img-wrapper {
        width: 100px;
        height: 100px;
        background: var(--white);
        border-radius: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.03);
    }
    .symbol-img-wrapper img {
        width: 60px;
        height: 60px;
        object-fit: contain;
    }
    .modal-content {
        border-radius: 40px;
        border: none;
        overflow: hidden;
    }
    .modal-header {
        background: var(--navy);
        color: white;
        padding: 30px 40px;
        border: none;
    }
    .modal-body {
        padding: 40px;
    }

    @media (max-width: 767.98px) {
        .page-header {
            padding: 60px 0;
            border-radius: 0 0 30px 30px;
        }
        .page-header h1 {
            font-size: 1.8rem;
        }
        .nav-pills-premium {
            display: flex;
            overflow-x: auto;
            white-space: nowrap;
            width: 100%;
            padding: 5px;
        }
        .nav-pills-premium .nav-link {
            padding: 10px 15px;
            font-size: 0.85rem;
        }
        .symbol-card {
            padding: 20px 15px;
            border-radius: 20px;
        }
        .symbol-img-wrapper {
            width: 70px;
            height: 70px;
            border-radius: 15px;
            margin-bottom: 15px;
        }
        .symbol-img-wrapper img {
            width: 40px;
            height: 40px;
        }
        .modal-content {
            border-radius: 25px;
        }
        .modal-header {
            padding: 20px;
        }
        .modal-body {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header text-center">
    <div class="container" data-aos="fade-down">
        <h6 class="text-blue-light fw-bold text-uppercase">Ensiklopedia Tekstil</h6>
        <h1 class="display-4 fw-800">Simbol Perawatan Pakaian</h1>
        <p class="text-white-50 mx-auto mt-3" style="max-width: 600px;">Berdasarkan standar internasional ISO 3758:2012 & 2023 untuk membantu Anda memahami label pada pakaian.</p>
    </div>
</div>

<section class="pt-0">
    <div class="container">
        <!-- Filters -->
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="nav nav-pills nav-pills-premium mb-4" id="pills-tab" role="tablist">
                <button class="nav-link active" id="pills-all-tab" data-bs-toggle="pill" data-bs-target="#pills-all" type="button" role="tab">Semua</button>
                @foreach($categories as $cat)
                <button class="nav-link" id="pills-{{ $cat->id }}-tab" data-bs-toggle="pill" data-bs-target="#pills-{{ $cat->id }}" type="button" role="tab">{{ explode(' ', $cat->name)[0] }}</button>
                @endforeach
            </div>
        </div>

        <!-- Grid -->
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-all" role="tabpanel">
                <div class="row g-4">
                    @foreach($symbols as $symbol)
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $loop->index % 4 * 100 }}">
                        <div class="symbol-card card" data-bs-toggle="modal" data-bs-target="#symbolModal{{ $symbol->id }}">
                            <div class="symbol-img-wrapper">
                                @php
                                    $symbolImageUrl = $symbol->image_path
                                        ? (\Illuminate\Support\Str::startsWith($symbol->image_path, ['http://', 'https://']) ? $symbol->image_path : asset(ltrim($symbol->image_path, '/')))
                                        : 'https://via.placeholder.com/100';
                                @endphp
                                <img src="{{ $symbolImageUrl }}" alt="{{ $symbol->name }}">
                            </div>
                            <h6 class="fw-bold mb-1">{{ $symbol->name }}</h6>
                            <span class="badge bg-soft-gray text-navy rounded-pill mb-2 small">{{ $symbol->iso_code }}</span>
                            <p class="text-muted small mb-0">{{ Str::limit($symbol->description_short, 40) }}</p>
                        </div>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="symbolModal{{ $symbol->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Detail Simbol</h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <div class="bg-soft-gray rounded-4 p-5 mb-4">
                                        <img src="{{ $symbolImageUrl }}" style="width: 120px;" alt="{{ $symbol->name }}">
                                    </div>
                                    <h3 class="fw-800 text-navy mb-1">{{ $symbol->name }}</h3>
                                    <p class="text-blue-light fw-bold mb-4">{{ $symbol->iso_code }}</p>
                                    <div class="text-start">
                                        <h6 class="fw-bold"><i class="bi bi-info-circle me-2"></i>Penjelasan</h6>
                                        <p class="text-muted">{{ $symbol->description_long }}</p>
                                        <hr>
                                        <h6 class="fw-bold"><i class="bi bi-tags me-2"></i>Kategori</h6>
                                        <span class="badge bg-blue-soft text-blue-light">{{ $symbol->category->name }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            @foreach($categories as $cat)
            <div class="tab-pane fade" id="pills-{{ $cat->id }}" role="tabpanel">
                <div class="row g-4">
                    @foreach($cat->careSymbols as $symbol)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="symbol-card card" data-bs-toggle="modal" data-bs-target="#symbolModal{{ $symbol->id }}">
                            <div class="symbol-img-wrapper">
                                @php
                                    $symbolImageUrl = $symbol->image_path
                                        ? (\Illuminate\Support\Str::startsWith($symbol->image_path, ['http://', 'https://']) ? $symbol->image_path : asset(ltrim($symbol->image_path, '/')))
                                        : 'https://via.placeholder.com/100';
                                @endphp
                                <img src="{{ $symbolImageUrl }}" alt="{{ $symbol->name }}">
                            </div>
                            <h6 class="fw-bold mb-1">{{ $symbol->name }}</h6>
                            <span class="badge bg-soft-gray text-navy rounded-pill mb-2 small">{{ $symbol->iso_code }}</span>
                            <p class="text-muted small mb-0">{{ Str::limit($symbol->description_short, 40) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
