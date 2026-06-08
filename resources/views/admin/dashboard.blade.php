@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card bg-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-calendar-check fs-3 text-primary"></i>
                    </div>
                    <span class="badge bg-success rounded-pill">Hari Ini</span>
                </div>
                <h6 class="text-muted mb-1">Rekomendasi Hari Ini</h6>
                <h2 class="fw-bold mb-0">{{ $stats['today'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-info bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-calendar-week fs-3 text-info"></i>
                    </div>
                    <span class="badge bg-primary rounded-pill">Minggu Ini</span>
                </div>
                <h6 class="text-muted mb-1">Rekomendasi Minggu Ini</h6>
                <h2 class="fw-bold mb-0">{{ $stats['week'] }}</h2>
            </div>
        </div>
    </div>
    <div class="col-md-4 mb-4">
        <div class="card bg-white h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3">
                        <i class="bi bi-calendar-month fs-3 text-warning"></i>
                    </div>
                    <span class="badge bg-dark rounded-pill">Bulan Ini</span>
                </div>
                <h6 class="text-muted mb-1">Rekomendasi Bulan Ini</h6>
                <h2 class="fw-bold mb-0">{{ $stats['month'] }}</h2>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8 mb-4">
        <div class="card bg-white h-100">
            <div class="card-header bg-transparent border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                <h5 class="fw-bold m-0">Tren Rekomendasi</h5>
                <a href="{{ route('admin.export') }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                    <i class="bi bi-file-earmark-excel me-1"></i> Export Excel
                </a>
            </div>
            <div class="card-body p-4">
                <canvas id="recChart" style="max-height: 300px;"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4 mb-4">
        <div class="card bg-white mb-4">
            <div class="card-body p-4 text-center">
                <div class="bg-danger bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                    <i class="bi bi-star-fill fs-3 text-danger"></i>
                </div>
                <h6 class="text-muted mb-1">Metode Terpopuler</h6>
                <h5 class="fw-bold">{{ $stats['popular_method'] }}</h5>
            </div>
        </div>
        <div class="card bg-white">
            <div class="card-body p-4 text-center">
                <div class="bg-success bg-opacity-10 p-3 rounded-circle d-inline-flex mb-3">
                    <i class="bi bi-journal-check fs-3 text-success"></i>
                </div>
                <h6 class="text-muted mb-1">Artikel Terpopuler</h6>
                <h5 class="fw-bold">{{ $stats['popular_article'] }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('recChart');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($chartData['labels']) !!},
            datasets: [{
                label: 'Jumlah Rekomendasi',
                data: {!! json_encode($chartData['values']) !!},
                borderColor: '#3498db',
                backgroundColor: 'rgba(52, 152, 219, 0.1)',
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1 } }
            }
        }
    });
</script>
@endsection
