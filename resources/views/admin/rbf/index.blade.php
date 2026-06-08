@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Aturan Rule-Based Filtering</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.rbf.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari aturan..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah Aturan
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Kode</th>
                        <th>Kondisi (IF)</th>
                        <th>Metode Dieliminasi (THEN)</th>
                        <th>Alasan</th>
                        <th>Status</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rules as $rule)
                    <tr>
                        <td class="ps-4 fw-bold text-primary">{{ $rule->rule_code }}</td>
                        <td>
                            <div class="small fw-semibold">
                                @if($rule->fabric) <span class="badge bg-light text-navy border">Kain: {{ $rule->fabric }}</span> @endif
                                @if($rule->color) <span class="badge bg-light text-navy border">Warna: {{ $rule->color }}</span> @endif
                                @if($rule->motif) <span class="badge bg-light text-navy border">Motif: {{ $rule->motif }}</span> @endif
                                @if($rule->dirt_level) <span class="badge bg-light text-navy border">Kekotoran: {{ $rule->dirt_level }}</span> @endif
                            </div>
                            <div class="text-muted x-small mt-1">{{ $rule->condition_desc }}</div>
                        </td>
                        <td>
                            <span class="badge bg-danger rounded-pill px-3">{{ $rule->eliminated_method }}</span>
                        </td>
                        <td class="small text-muted">{{ Str::limit($rule->reason, 50) }}</td>
                        <td>
                            @if($rule->is_active)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Aktif</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $rule->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.rbf.destroy', $rule->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus aturan ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $rule->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.rbf.update', $rule->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Aturan RBF</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label class="form-label">Kode Aturan</label>
                                                <input type="text" name="rule_code" class="form-control" value="{{ $rule->rule_code }}" required>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Jenis Kain</label>
                                                <select name="fabric" class="form-select">
                                                    <option value="">- Semua -</option>
                                                    @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                                                    <option value="{{ $f }}" {{ $rule->fabric == $f ? 'selected' : '' }}>{{ $f }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Warna</label>
                                                <select name="color" class="form-select">
                                                    <option value="">- Semua -</option>
                                                    @foreach(['Putih', 'Gelap', 'Terang/Cerah'] as $c)
                                                    <option value="{{ $c }}" {{ $rule->color == $c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Motif</label>
                                                <select name="motif" class="form-select">
                                                    <option value="">- Semua -</option>
                                                    @foreach(['Polos', 'Batik', 'Sablon/Bordir'] as $m)
                                                    <option value="{{ $m }}" {{ $rule->motif == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Kekotoran</label>
                                                <select name="dirt_level" class="form-select">
                                                    <option value="">- Semua -</option>
                                                    @foreach(['Ringan', 'Sedang', 'Berat'] as $d)
                                                    <option value="{{ $d }}" {{ $rule->dirt_level == $d ? 'selected' : '' }}>{{ $d }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Metode Dieliminasi</label>
                                                <select name="eliminated_method" class="form-select" required>
                                                    @foreach(['M1','M2','M3','M4','M5'] as $m)
                                                    <option value="{{ $m }}" {{ $rule->eliminated_method == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Deskripsi Kondisi</label>
                                                <input type="text" name="condition_desc" class="form-control" value="{{ $rule->condition_desc }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Alasan Eliminasi</label>
                                                <textarea name="reason" class="form-control" rows="2">{{ $rule->reason }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-check form-switch mt-2">
                                                    <input class="form-check-input" type="checkbox" name="is_active" value="1" {{ $rule->is_active ? 'checked' : '' }}>
                                                    <label class="form-check-label">Status Aktif</label>
                                                </div>
                                            </div>
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
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $rules->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.rbf.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Aturan RBF Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Kode Aturan</label>
                            <input type="text" name="rule_code" class="form-control" placeholder="Contoh: R41" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Jenis Kain</label>
                            <select name="fabric" class="form-select">
                                <option value="">- Semua -</option>
                                @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                                <option value="{{ $f }}">{{ $f }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Warna</label>
                            <select name="color" class="form-select">
                                <option value="">- Semua -</option>
                                @foreach(['Putih', 'Gelap', 'Terang/Cerah'] as $c)
                                <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Motif</label>
                            <select name="motif" class="form-select">
                                <option value="">- Semua -</option>
                                @foreach(['Polos', 'Batik', 'Sablon/Bordir'] as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Kekotoran</label>
                            <select name="dirt_level" class="form-select">
                                <option value="">- Semua -</option>
                                @foreach(['Ringan', 'Sedang', 'Berat'] as $d)
                                <option value="{{ $d }}">{{ $d }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Metode Dieliminasi</label>
                            <select name="eliminated_method" class="form-select" required>
                                <option value="M1">M1 - Cuci tangan air dingin</option>
                                <option value="M2">M2 - Cuci tangan air hangat</option>
                                <option value="M3">M3 - Mesin cuci normal</option>
                                <option value="M4">M4 - Mesin cuci halus</option>
                                <option value="M5">M5 - Dry cleaning</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Deskripsi Kondisi</label>
                            <input type="text" name="condition_desc" class="form-control" placeholder="Contoh: Jika bahan Denim maka...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Alasan Eliminasi</label>
                            <textarea name="reason" class="form-control" rows="2" placeholder="Alasan mengapa metode ini tidak layak..."></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Aturan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
