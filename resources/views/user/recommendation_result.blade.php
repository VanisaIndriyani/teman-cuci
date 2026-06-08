@extends('layouts.user')

@section('styles')
<style>
    .result-header {
        background: radial-gradient(circle at center, var(--navy-light), var(--navy));
        padding: 80px 0;
        color: white;
        text-align: center;
        border-radius: 0 0 60px 60px;
    }
    .best-method-card {
        margin-top: -60px;
        border-radius: 40px;
        overflow: hidden;
        border: none;
        box-shadow: 0 30px 70px rgba(10, 25, 47, 0.15);
    }
    .best-method-sidebar {
        background: var(--blue-light);
        color: white;
        padding: 60px 40px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .score-circle {
        width: 140px;
        height: 140px;
        border: 8px solid rgba(255,255,255,0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        font-size: 2.5rem;
        font-weight: 800;
    }
    .timeline-item {
        position: relative;
        padding-left: 50px;
        margin-bottom: 30px;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: -30px;
        width: 2px;
        background: var(--blue-soft);
    }
    .timeline-item:last-child::before { display: none; }
    .timeline-number {
        position: absolute;
        left: 0;
        top: 0;
        width: 32px;
        height: 32px;
        background: var(--navy);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        z-index: 2;
    }
    .detergent-item {
        background: var(--blue-soft);
        border-radius: 20px;
        padding: 20px;
        margin-bottom: 15px;
        border-left: 5px solid var(--blue-light);
    }
    .ranking-table thead th {
        background: var(--navy);
        color: white;
        border: none;
        padding: 20px;
    }
    .ranking-table tbody td {
        padding: 20px;
        vertical-align: middle;
    }
    .badge-premium {
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.8rem;
        text-transform: uppercase;
    }

    @media (max-width: 991.98px) {
        .result-header {
            padding: 60px 0 100px;
            border-radius: 0 0 40px 40px;
        }
        .best-method-card {
            margin-top: -80px;
            border-radius: 30px;
        }
        .best-method-sidebar {
            padding: 40px 20px;
        }
        .score-circle {
            width: 100px;
            height: 100px;
            font-size: 1.8rem;
            border-width: 6px;
        }
        .card-body.p-5 {
            padding: 30px 20px !important;
        }
        .result-header h1 {
            font-size: 2rem;
        }
        .cta-buttons {
            flex-direction: column;
            gap: 15px;
        }
        .cta-buttons .btn {
            width: 100%;
        }
    }

    /* Print & PDF Styling */
    @media print, .is-printing {
        @page {
            margin: 0;
            size: A4;
        }
        .navbar, .footer, .cta-buttons, .text-muted.mt-4, .nav-item, .btn-admin {
            display: none !important;
        }
        body {
            background: #f4f7f6 !important;
            padding: 0 !important;
            margin: 0 !important;
            -webkit-print-color-adjust: exact;
        }
        #report-content {
            background: #f4f7f6 !important;
            width: 210mm !important;
            padding: 0 !important;
            margin: 0 auto !important;
        }
        .result-header {
            background: #0a192f !important;
            color: white !important;
            padding: 40px 60px !important;
            border-radius: 0 !important;
            text-align: left !important;
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
        }
        .result-header h1 {
            font-size: 28pt !important;
            margin: 0 !important;
            font-weight: 800 !important;
        }
        .best-method-card {
            margin: 30px 40px !important;
            border-radius: 20px !important;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05) !important;
            border: 1px solid #e2e8f0 !important;
            background: white !important;
            page-break-inside: avoid;
        }
        .best-method-sidebar {
            background: #3498db !important;
            color: white !important;
            padding: 40px !important;
            border-radius: 20px 0 0 20px !important;
        }
        .score-circle {
            width: 100px !important;
            height: 100px !important;
            border: 5px solid rgba(255,255,255,0.2) !important;
            background: rgba(255,255,255,0.1) !important;
        }
        .timeline-number {
            background: #3498db !important;
        }
        .detergent-item {
            background: #f8fafc !important;
            border: 1px solid #edf2f7 !important;
        }
        .ranking-table thead th {
            background: #0a192f !important;
            color: white !important;
        }
        .card {
            border-radius: 20px !important;
            margin: 0 40px !important;
        }
        .bg-navy {
            background: #0a192f !important;
            color: white !important;
            border-radius: 15px !important;
        }
    }
</style>
@endsection

@section('content')
<div class="result-header">
    <div class="container" data-aos="fade-down">
        <h6 class="text-blue-light fw-bold text-uppercase">Hasil Analisis Selesai</h6>
        <h1 class="display-4 fw-800">Rekomendasi Terbaik</h1>
    </div>
</div>

<section class="pt-0">
    <div class="container">
        @php $best = $results[0]; @endphp
        
        <!-- Best Method -->
        <div class="best-method-card card mb-5" data-aos="fade-up">
            <div class="row g-0">
                <div class="col-lg-4 best-method-sidebar">
                    <span class="badge bg-white text-blue-light mb-4 px-3 py-2 rounded-pill fw-bold mx-auto" style="width: fit-content;">REKOMENDASI UTAMA</span>
                    <h2 class="fw-800 mb-4">{{ $best['method_name'] }}</h2>
                    <div class="score-circle">
                        {{ number_format($best['score'] * 100, 0) }}%
                    </div>
                    <p class="opacity-75">Skor Kelayakan Berdasarkan SAW</p>
                </div>
                <div class="col-lg-8">
                    <div class="card-body p-5">
                        <div class="row">
                            <div class="col-md-7">
                                <h4 class="fw-800 mb-4"><i class="bi bi-list-stars text-blue-light me-2"></i>Langkah Pencucian</h4>
                                <div class="timeline mt-4">
                                    @foreach($best['steps'] as $step)
                                    <div class="timeline-item">
                                        <div class="timeline-number">{{ $step->step_order }}</div>
                                        <h6 class="fw-bold mb-1">{{ $step->title }}</h6>
                                        <p class="text-muted small mb-0">{{ $step->description }}</p>
                                        @if($step->tip)
                                        <div class="alert alert-warning py-2 px-3 mt-2 border-0 rounded-3 small">
                                            <i class="bi bi-lightbulb me-1"></i> <strong>Tips:</strong> {{ $step->tip }}
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h4 class="fw-800 mb-4"><i class="bi bi-droplet-fill text-blue-light me-2"></i>Deterjen</h4>
                                @forelse($best['detergents'] as $det)
                                <div class="detergent-item">
                                    <h6 class="fw-bold mb-1">{{ $det->detergent_name }}</h6>
                                    <span class="badge bg-blue-light mb-2">{{ $det->detergent_type }}</span>
                                    <p class="text-muted small mb-0">{{ $det->description }}</p>
                                </div>
                                @empty
                                <p class="text-muted small">Gunakan deterjen pH netral atau deterjen cair umum.</p>
                                @endforelse

                                <div class="mt-5 p-4 bg-navy text-white rounded-4">
                                    <h6 class="fw-bold mb-2"><i class="bi bi-info-circle me-2"></i>Ringkasan Input</h6>
                                    <ul class="list-unstyled small mb-0 opacity-75">
                                        <li class="mb-1">• Kain: {{ $input['fabric_type'] }}</li>
                                        <li class="mb-1">• Warna: {{ $input['color'] }}</li>
                                        <li class="mb-1">• Motif: {{ $input['pattern'] }}</li>
                                        <li>• Kekotoran: {{ $input['dirt_level'] }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ranking Table -->
        <div class="row justify-content-center">
            <div class="col-lg-10" data-aos="fade-up">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-5">
                    <div class="card-header bg-white p-4 border-0">
                        <h4 class="fw-800 mb-0">Peringkat Alternatif</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table ranking-table mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">Rank</th>
                                    <th>Metode Pencucian</th>
                                    <th class="text-center">Skor Akhir</th>
                                    <th class="text-end pe-4">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($results as $index => $res)
                                <tr>
                                    <td class="ps-4">
                                        @if($index == 0)
                                            <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">1</div>
                                        @else
                                            <div class="bg-soft-gray text-navy rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">{{ $index + 1 }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="fw-bold">{{ $res['method_name'] }}</span>
                                        <small class="d-block text-muted">{{ $res['method_code'] }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-blue-soft text-blue-light px-3 py-2 rounded-3 fw-bold">{{ number_format($res['score'], 4) }}</span>
                                    </td>
                                    <td class="text-end pe-4">
                                        @if($index == 0)
                                            <span class="badge-premium bg-success text-white">Sangat Disarankan</span>
                                        @elseif($res['score'] > 0.7)
                                            <span class="badge-premium bg-info text-white">Layak</span>
                                        @else
                                            <span class="badge-premium bg-secondary text-white">Alternatif</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- PDF TEMPLATE (SEPARATE FILE) -->
<div id="pdf-template" style="display: none;">
    @include('pdf.recommendation-report')
</div>

<div class="container pb-5">
    <!-- CTA -->
    <div class="text-center" data-aos="fade-up">
        <div class="d-flex justify-content-center gap-3 cta-buttons">
            <a href="{{ route('consultation') }}" class="btn btn-navy rounded-pill px-5">Analisis Pakaian Lain</a>
          
        </div>
        <p class="text-muted mt-4 small">Hasil ini didasarkan pada perhitungan matematis Simple Additive Weighting.</p>
    </div>
</div>

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
    function downloadPDF() {
        const element = document.getElementById('pdf-template');
        
        element.style.display = 'block';
        element.style.position = 'fixed';
        element.style.left = '0';
        element.style.top = '0';
        element.style.transform = 'translateX(-120%)';
        element.style.width = '210mm';
        
        const opt = {
            margin:       [0, 0],
            filename:     'Laporan_Pencucian_TemanCuci.pdf',
            image:        { type: 'jpeg', quality: 1.0 },
            html2canvas:  { 
                scale: 2, 
                useCORS: true, 
                letterRendering: true,
                backgroundColor: '#ffffff'
            },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' }
        };
        
        setTimeout(() => {
            html2pdf().set(opt).from(element).toPdf().get('pdf').then(function () {
                element.style.display = 'none';
            }).save();
        }, 50);
    }
</script>
@endsection
@endsection
