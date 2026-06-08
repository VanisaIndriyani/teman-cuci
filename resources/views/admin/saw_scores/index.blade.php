@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold m-0">Sub Kriteria SAW</h4>
        <div class="text-muted small mt-1">Atur nilai skor (0-5) untuk tiap metode (M1-M5) per atribut kriteria.</div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
    <div class="card-body p-4">
        <div class="d-flex flex-wrap gap-2">
            @foreach($criteria as $code => $name)
                <a href="{{ route('admin.saw-scores.index', ['criterion' => $code]) }}"
                   class="btn btn-sm rounded-pill px-4 {{ $selectedCriterion === $code ? 'btn-primary' : 'btn-light' }}">
                    <span class="fw-bold">{{ $code }}</span> <span class="opacity-75 ms-1">{{ $name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body p-0">
                <form action="{{ route('admin.saw-scores.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="criterion" value="{{ $selectedCriterion }}">

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th class="ps-4">Atribut</th>
                                    @foreach($methods as $m)
                                        <th class="text-center">{{ $m }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($attributeValues as $attr)
                                    <tr>
                                        <td class="ps-4 fw-semibold">{{ $attr }}</td>
                                        @foreach($methods as $m)
                                            <td class="text-center" style="min-width: 110px;">
                                                <input type="number"
                                                       min="0"
                                                       max="5"
                                                       step="1"
                                                       name="scores[{{ $attr }}][{{ $m }}]"
                                                       value="{{ $matrix[$attr][$m] ?? 0 }}"
                                                       class="form-control form-control-sm text-center"
                                                       required>
                                            </td>
                                        @endforeach
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ 1 + count($methods) }}" class="text-center py-5 text-muted">
                                            Belum ada data sub-kriteria untuk {{ $selectedCriterion }}.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-4">
                            <i class="bi bi-save me-2"></i>Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-navy text-white p-4 border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i> Info Sub Kriteria</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <div class="small text-muted">
                    <div class="mb-3">Skor dipakai untuk menyusun matriks keputusan SAW.</div>
                    <div class="mb-2"><span class="fw-bold text-navy">0</span> = tidak direkomendasikan / tidak cocok</div>
                    <div class="mb-2"><span class="fw-bold text-navy">1</span> = sangat rendah</div>
                    <div class="mb-2"><span class="fw-bold text-navy">3</span> = sedang</div>
                    <div class="mb-2"><span class="fw-bold text-navy">5</span> = sangat tinggi</div>
                </div>
                <hr>
                <div class="small text-muted">
                    Jika semua skor per metode sama, hasil normalisasi bisa jadi 1.000 semua. Pastikan tiap atribut punya variasi antar metode.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

