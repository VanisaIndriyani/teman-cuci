@extends('layouts.user')

@section('styles')
<style>
    .consult-page {
        background: radial-gradient(circle at top right, var(--white) 0%, var(--blue-soft) 100%);
        min-height: 80vh;
        padding: 80px 0;
    }
    .consult-card {
        border-radius: 40px;
        box-shadow: 0 40px 100px rgba(10, 25, 47, 0.08);
        border: none;
        overflow: hidden;
        background: white;
    }
    .form-header {
        background: linear-gradient(135deg, var(--navy) 0%, var(--blue-light) 100%);
        padding: 80px 40px;
        color: white;
        text-align: center;
        position: relative;
    }
    .form-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40px;
        background: white;
        clip-path: ellipse(50% 100% at 50% 100%);
    }
    .form-body {
        padding: 40px 60px 60px;
    }
    .form-label {
        font-weight: 700;
        color: var(--navy);
        margin-bottom: 12px;
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .form-select, .form-control {
        border-radius: 20px;
        padding: 18px 25px;
        border: 2px solid #edf2f7;
        background-color: #f8fafc;
        transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        font-weight: 600;
        color: var(--navy);
        appearance: none;
    }
    .form-select:focus, .form-control:focus {
        border-color: var(--blue-light);
        background-color: var(--white);
        box-shadow: 0 10px 25px rgba(52, 152, 219, 0.15);
        transform: translateY(-2px);
    }
    .option-group {
        background: var(--white);
        padding: 40px;
        border-radius: 30px;
        border: 1px solid #edf2f7;
        margin-bottom: 30px;
        transition: all 0.3s ease;
    }
    .option-group:hover {
        border-color: var(--blue-light);
        box-shadow: 0 15px 35px rgba(0,0,0,0.03);
    }
    .check-card {
        background: #f8fafc;
        padding: 20px;
        border-radius: 20px;
        border: 2px solid transparent;
        transition: all 0.3s;
        cursor: pointer;
        display: block;
        margin-bottom: 15px;
    }
    .form-check-input {
        width: 24px;
        height: 24px;
        margin-top: 0;
        margin-right: 12px;
        cursor: pointer;
    }
    .form-check-input:checked + .form-check-label {
        color: var(--navy);
        font-weight: 700;
    }
    .form-check-input:checked ~ .check-card {
        border-color: var(--blue-light);
        background: white;
        box-shadow: 0 5px 15px rgba(52, 152, 219, 0.1);
    }
    .btn-submit {
        padding: 22px;
        font-size: 1.2rem;
        letter-spacing: 1px;
        border-radius: 25px !important;
        background: linear-gradient(135deg, var(--blue-light) 0%, var(--navy) 100%);
        border: none;
        transition: all 0.4s;
    }
    .btn-submit:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(52, 152, 219, 0.3);
    }

    @media (max-width: 767.98px) {
        .form-header { padding: 60px 20px; }
        .form-body { padding: 30px 20px; }
        .option-group { padding: 25px; }
    }
</style>
@endsection

@section('content')
<section class="consult-page">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-9" data-aos="fade-up">
                <div class="consult-card card">
                    <div class="form-header">
                        <span class="badge bg-white text-primary mb-3 px-3 py-2 rounded-pill fw-bold">STEP BY STEP ANALYSIS</span>
                        <h2 class="fw-800 mb-2 display-6">Analisis Cerdas Pakaian</h2>
                        <p class="text-white-50 mb-0">Lengkapi data berikut untuk mendapatkan metode pencucian yang paling aman & efisien.</p>
                    </div>
                    <div class="form-body">
                        <form action="{{ route('consultation.process') }}" method="POST">
                            @csrf
                            
                            <div class="row">
                                <div class="col-12 mb-4">
                                    <h5 class="fw-800 text-navy"><span class="text-primary me-2">01.</span> Karakteristik Dasar</h5>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Jenis Kain</label>
                                    <div class="position-relative">
                                        <select name="fabric_type" class="form-select" required>
                                            <option value="" disabled selected>Pilih Jenis Kain</option>
                                            <option value="Katun">Katun</option>
                                            <option value="Rayon">Rayon</option>
                                            <option value="Denim">Denim</option>
                                            <option value="Linen">Linen</option>
                                            <option value="Poliester">Poliester</option>
                                        </select>
                                        <i class="bi bi-chevron-down position-absolute" style="right: 25px; top: 22px; color: var(--navy); pointer-events: none;"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Warna Dominan</label>
                                    <div class="position-relative">
                                        <select name="color" class="form-select" required>
                                            <option value="" disabled selected>Pilih Warna</option>
                                            <option value="Putih">Putih</option>
                                            <option value="Gelap">Gelap (Hitam, Navy, Coklat)</option>
                                            <option value="Terang/Cerah">Terang/Cerah (Merah, Kuning, Pastel)</option>
                                        </select>
                                        <i class="bi bi-chevron-down position-absolute" style="right: 25px; top: 22px; color: var(--navy); pointer-events: none;"></i>
                                    </div>
                                </div>
                                
                                <div class="col-12 mt-4 mb-4">
                                    <h5 class="fw-800 text-navy"><span class="text-primary me-2">02.</span> Detail & Kondisi</h5>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Motif / Ornamen</label>
                                    <div class="position-relative">
                                        <select name="pattern" class="form-select" required>
                                            <option value="" disabled selected>Pilih Motif</option>
                                            <option value="Polos">Polos</option>
                                            <option value="Batik">Batik (Tulis/Cap)</option>
                                            <option value="Sablon/Bordir">Sablon atau Bordir</option>
                                        </select>
                                        <i class="bi bi-chevron-down position-absolute" style="right: 25px; top: 22px; color: var(--navy); pointer-events: none;"></i>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label">Tingkat Kekotoran</label>
                                    <div class="position-relative">
                                        <select name="dirt_level" class="form-select" required>
                                            <option value="" disabled selected>Pilih Tingkat</option>
                                            <option value="Ringan">Ringan (Debu / pemakaian sebentar)</option>
                                            <option value="Sedang">Sedang (Noda kering / keringat)</option>
                                            <option value="Berat">Berat (Lumpur / Minyak / Bau Tajam)</option>
                                        </select>
                                        <i class="bi bi-chevron-down position-absolute" style="right: 25px; top: 22px; color: var(--navy); pointer-events: none;"></i>
                                    </div>
                                </div>

                                <div class="col-12 mt-4 mb-4">
                                    <h5 class="fw-800 text-navy"><span class="text-primary me-2">03.</span> Informasi Khusus <small class="text-muted fw-normal fs-6 ms-2">(Opsional)</small></h5>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-check p-0 d-block">
                                        <input class="form-check-input d-none" type="checkbox" name="is_batik_printing" value="1" id="batikCheck">
                                        <div class="check-card d-flex align-items-center">
                                            <div class="check-icon me-3"><i class="bi bi-printer fs-4 text-primary"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Batik Modern</h6>
                                                <small class="text-muted">Motif cap pabrik / printing</small>
                                            </div>
                                        </div>
                                    </label>
                                    
                                    <label class="form-check p-0 d-block">
                                        <input class="form-check-input d-none" type="checkbox" name="is_polyester_blend" value="1" id="polyCheck">
                                        <div class="check-card d-flex align-items-center">
                                            <div class="check-icon me-3"><i class="bi bi-layers fs-4 text-primary"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Kain Campuran</h6>
                                                <small class="text-muted">Poliester blend &ge; 50%</small>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="form-check p-0 d-block">
                                        <input class="form-check-input d-none" type="checkbox" name="is_denim_new" value="1" id="denimCheck">
                                        <div class="check-card d-flex align-items-center">
                                            <div class="check-icon me-3"><i class="bi bi-stars fs-4 text-primary"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Denim Baru</h6>
                                                <small class="text-muted">&lt; 5 kali proses pencucian</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-check p-0 d-block">
                                        <input class="form-check-input d-none" type="checkbox" name="is_sablon_rubber" value="1" id="rubberCheck">
                                        <div class="check-card d-flex align-items-center">
                                            <div class="check-icon me-3"><i class="bi bi-shield-exclamation fs-4 text-primary"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Sablon Karet</h6>
                                                <small class="text-muted">Sablon rubber / sensitif panas</small>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="form-check p-0 d-block">
                                        <input class="form-check-input d-none" type="checkbox" name="is_bordir_small" value="1" id="bordirCheck">
                                        <div class="check-card d-flex align-items-center">
                                            <div class="check-icon me-3"><i class="bi bi-flower1 fs-4 text-primary"></i></div>
                                            <div>
                                                <h6 class="mb-0 fw-bold">Bordir Minimalis</h6>
                                                <small class="text-muted">Area kecil / tidak dominan</small>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <div class="d-grid mt-5 pt-4 border-top">
                                <button type="submit" class="btn btn-primary btn-submit fw-bold shadow-lg">
                                    Dapatkan Rekomendasi <i class="bi bi-arrow-right-circle-fill ms-2"></i>
                                </button>
                                <p class="text-center text-muted small mt-3">Proses analisis menggunakan algoritma RBF & SAW untuk akurasi tinggi.</p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Visual toggle for check-cards
    document.querySelectorAll('.check-card').forEach(card => {
        card.addEventListener('click', function() {
            const checkbox = this.closest('.form-check').querySelector('input');
            checkbox.checked = !checkbox.checked;
            
            if(checkbox.checked) {
                this.style.borderColor = 'var(--blue-light)';
                this.style.background = 'white';
                this.style.boxShadow = '0 5px 15px rgba(52, 152, 219, 0.1)';
                this.querySelector('h6').style.color = 'var(--navy)';
            } else {
                this.style.borderColor = 'transparent';
                this.style.background = '#f8fafc';
                this.style.boxShadow = 'none';
                this.querySelector('h6').style.color = 'inherit';
            }
        });
    });
</script>
@endsection
