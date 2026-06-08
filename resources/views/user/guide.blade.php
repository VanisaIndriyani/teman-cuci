@extends('layouts.user')

@section('styles')
<style>
    .guide-header {
        background: var(--navy);
        padding: 100px 0;
        color: white;
        border-radius: 0 0 60px 60px;
        margin-bottom: 60px;
    }
    .accordion-premium {
        border: none;
    }
    .accordion-premium .accordion-item {
        border: none;
        margin-bottom: 20px;
        border-radius: 25px !important;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.03);
    }
    .accordion-premium .accordion-button {
        padding: 25px 30px;
        font-weight: 700;
        color: var(--navy);
        background: var(--white);
        border: none;
        box-shadow: none;
    }
    .accordion-premium .accordion-button:not(.collapsed) {
        background: var(--blue-soft);
        color: var(--blue-light);
    }
    .accordion-premium .accordion-body {
        padding: 30px;
        color: var(--text-muted);
        line-height: 1.8;
    }

    @media (max-width: 767.98px) {
        .guide-header {
            padding: 60px 0;
            border-radius: 0 0 30px 30px;
        }
        .guide-header h1 {
            font-size: 2rem;
        }
        .accordion-premium .accordion-button {
            padding: 20px;
            font-size: 0.95rem;
        }
        .accordion-premium .accordion-body {
            padding: 20px;
            font-size: 0.9rem;
        }
        .p-5 {
            padding: 30px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="guide-header text-center">
    <div class="container" data-aos="fade-down">
        <h6 class="text-blue-light fw-bold text-uppercase">Bantuan & FAQ</h6>
        <h1 class="display-4 fw-800">Panduan Penggunaan</h1>
        <p class="text-white-50 mx-auto mt-3" style="max-width: 600px;">Temukan jawaban atas pertanyaan umum dan pelajari cara memaksimalkan fitur TemanCuci.</p>
    </div>
</div>

<section class="pt-0">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion accordion-premium" id="faqAccordion" data-aos="fade-up">
                    @forelse($faqs as $faq)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $faq->id }}">
                                {{ $faq->question }}
                            </button>
                        </h2>
                        <div id="faq{{ $faq->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                {!! nl2br(e($faq->answer)) !!}
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-question-circle fs-1 text-muted"></i>
                        <p class="mt-3">Belum ada FAQ yang tersedia.</p>
                    </div>
                    @endforelse
                </div>
                
                <div class="mt-5 p-5 bg-blue-soft rounded-5 text-center" data-aos="fade-up">
                    <h4 class="fw-800 text-navy mb-3">Masih punya pertanyaan?</h4>
                    <p class="text-muted mb-4">Tim kami siap membantu Anda merawat pakaian dengan lebih baik.</p>
                    <a href="mailto:temancucistaff@gmail.com?subject=Konsultasi%20TemanCuci" class="btn btn-primary rounded-pill px-5">Hubungi CS Kami</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
