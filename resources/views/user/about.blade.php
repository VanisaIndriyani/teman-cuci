@extends('layouts.user')

@section('styles')
<style>
    .about-header {
        background: var(--navy);
        padding: 120px 0;
        color: white;
        border-radius: 0 0 80px 80px;
        position: relative;
    }
    .philosophy-card {
        background: var(--white);
        border-radius: 40px;
        padding: 60px;
        box-shadow: 0 30px 60px rgba(0,0,0,0.05);
        margin-top: -80px;
    }
    .icon-box {
        width: 60px;
        height: 60px;
        background: var(--blue-soft);
        color: var(--blue-light);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    @media (max-width: 991.98px) {
        .about-header {
            padding: 80px 0 120px;
            border-radius: 0 0 40px 40px;
        }
        .about-header h1 {
            font-size: 2.5rem;
        }
        .philosophy-card {
            padding: 30px 20px;
            margin-top: -80px;
            border-radius: 30px;
            text-align: center;
        }
        .philosophy-card .fs-5 {
            font-size: 1.1rem !important;
        }
    }
</style>
@endsection

@section('content')
<div class="about-header text-center">
    <div class="container" data-aos="fade-down">
        <h1 class="display-3 fw-800">Tentang Teman<span class="text-blue-light">Cuci</span></h1>
        <p class="text-white-50 lead mx-auto" style="max-width: 700px;">Lebih dari sekadar aplikasi, kami adalah partner terpercaya untuk menjaga kualitas pakaian Anda.</p>
    </div>
</div>

<section class="pt-0">
    <div class="container">
        <div class="philosophy-card card" data-aos="fade-up">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-800 mb-4">Filosofi Kami</h2>
                    <p class="text-muted fs-5 lh-lg">TemanCuci lahir dari kepedulian terhadap kualitas dan umur panjang pakaian. Seperti seorang teman yang selalu memberikan saran terbaik, aplikasi ini hadir untuk membantu setiap orang merawat pakaian mereka dengan cara yang tepat, efisien, dan berdasarkan standar internasional.</p>
                </div>
                <div class="col-lg-6">
                    <img src="https://img.freepik.com/free-vector/cleaning-concept-illustration_114360-3162.jpg" class="img-fluid rounded-5" alt="Filosofi">
                </div>
            </div>

            <hr class="my-5">

            <div class="row g-4 text-center mt-2">
                <div class="col-md-4">
                    <div class="icon-box mx-auto"><i class="bi bi-shield-check"></i></div>
                    <h5 class="fw-bold">Fungsi Utama</h5>
                    <p class="text-muted small">Memberikan rekomendasi metode pencucian yang tepat berdasarkan karakteristik spesifik pakaian Anda.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon-box mx-auto"><i class="bi bi-book"></i></div>
                    <h5 class="fw-bold">Edukasi</h5>
                    <p class="text-muted small">Meningkatkan literasi perawatan tekstil melalui ensiklopedia simbol care dan artikel mendalam.</p>
                </div>
                <div class="col-md-4">
                    <div class="icon-box mx-auto"><i class="bi bi-tree"></i></div>
                    <h5 class="fw-bold">Tujuan Lingkungan</h5>
                    <p class="text-muted small">Membantu mengurangi limbah tekstil dengan memperpanjang masa pakai pakaian kesayangan Anda.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
