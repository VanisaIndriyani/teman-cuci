@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Manajemen Bobot SAW</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.saw.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari kriteria..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Kode</th>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                                <th class="text-end pe-4">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $totalWeight = 0; @endphp
                            @foreach($weights as $weight)
                            @php $totalWeight += $weight->weight; @endphp
                            <tr>
                                <td class="ps-4 fw-bold">{{ $weight->criterion_code }}</td>
                                <td>{{ $weight->criterion_name }}</td>
                                <td><span class="badge bg-primary rounded-pill px-3">{{ number_format($weight->weight, 2) }}</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $weight->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal{{ $weight->id }}" tabindex="-1">
                                <div class="modal-dialog">
                                    <div class="modal-content rounded-4 border-0">
                                        <form action="{{ route('admin.saw.update', $weight->id) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="fw-bold">Edit Bobot Kriteria</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Kriteria</label>
                                                    <input type="text" class="form-control" value="{{ $weight->criterion_name }}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Bobot (0.00 - 1.00)</label>
                                                    <input type="number" step="0.01" min="0" max="1" name="weight" class="form-control" value="{{ $weight->weight }}" required>
                                                    <div class="form-text">Pastikan total semua bobot adalah 1.00</div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pt-0">
                                                <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-pill px-4">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="ps-4 fw-bold">Total Bobot</td>
                                <td colspan="2">
                                    <span class="badge {{ $totalWeight == 1 ? 'bg-success' : 'bg-danger' }} rounded-pill px-3">
                                        {{ number_format($totalWeight, 2) }}
                                    </span>
                                    @if($totalWeight != 1)
                                    <small class="text-danger ms-2"><i class="bi bi-exclamation-triangle"></i> Total bobot harus 1.00</small>
                                    @endif
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-header bg-navy text-white p-4 border-0">
                <h5 class="fw-bold mb-0"><i class="bi bi-info-circle me-2"></i> Info Kriteria</h5>
            </div>
            <div class="card-body p-4 bg-white">
                <p class="small text-muted mb-4">Bobot SAW (Simple Additive Weighting) digunakan untuk meranking metode pencucian setelah lolos tahap filtering RBF.</p>
                
                <div class="d-flex flex-column gap-3">
                    <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                        <div class="fw-bold text-navy">C1: Jenis Kain</div>
                        <div class="small text-muted">Bobot: 0.30 (30%)</div>
                    </div>
                    <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                        <div class="fw-bold text-navy">C2: Motif</div>
                        <div class="small text-muted">Bobot: 0.25 (25%)</div>
                    </div>
                    <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                        <div class="fw-bold text-navy">C3: Tingkat Kekotoran</div>
                        <div class="small text-muted">Bobot: 0.25 (25%)</div>
                    </div>
                    <div class="p-3 bg-light rounded-3 border-start border-4 border-primary">
                        <div class="fw-bold text-navy">C4: Warna</div>
                        <div class="small text-muted">Bobot: 0.20 (20%)</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
