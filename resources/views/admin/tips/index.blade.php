@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Tips Perawatan Pakaian</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.tips.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari tips..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah Tips
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Metode</th>
                        <th>Filter (Kain/Warna/Motif)</th>
                        <th>Isi Tips</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tips as $tip)
                    <tr>
                        <td class="ps-4"><span class="badge bg-navy">{{ $tip->method_code }}</span></td>
                        <td>
                            <div class="small">
                                @if($tip->fabric_filter) <span class="badge bg-light text-navy border">Kain: {{ $tip->fabric_filter }}</span> @endif
                                @if($tip->color_filter) <span class="badge bg-light text-navy border">Warna: {{ $tip->color_filter }}</span> @endif
                                @if($tip->motif_filter) <span class="badge bg-light text-navy border">Motif: {{ $tip->motif_filter }}</span> @endif
                                @if(!$tip->fabric_filter && !$tip->color_filter && !$tip->motif_filter) <span class="text-muted">- Umum -</span> @endif
                            </div>
                        </td>
                        <td class="small text-muted">{{ Str::limit($tip->tip_text, 100) }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $tip->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.tips.destroy', $tip->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus tips ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $tip->id }}" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.tips.update', $tip->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Tips Perawatan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Metode Pencucian</label>
                                                <select name="method_code" class="form-select" required>
                                                    @foreach(['M1','M2','M3','M4','M5'] as $m)
                                                    <option value="{{ $m }}" {{ $tip->method_code == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jenis Kain (Filter)</label>
                                                <select name="fabric_filter" class="form-select">
                                                    <option value="">- Semua Kain -</option>
                                                    @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                                                    <option value="{{ $f }}" {{ $tip->fabric_filter == $f ? 'selected' : '' }}>{{ $f }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Warna (Filter)</label>
                                                <select name="color_filter" class="form-select">
                                                    <option value="">- Semua Warna -</option>
                                                    @foreach(['Putih', 'Gelap', 'Terang/Cerah'] as $c)
                                                    <option value="{{ $c }}" {{ $tip->color_filter == $c ? 'selected' : '' }}>{{ $c }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Motif (Filter)</label>
                                                <select name="motif_filter" class="form-select">
                                                    <option value="">- Semua Motif -</option>
                                                    @foreach(['Polos', 'Batik', 'Sablon/Bordir'] as $m)
                                                    <option value="{{ $m }}" {{ $tip->motif_filter == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Isi Tips</label>
                                                <textarea name="tip_text" class="form-control" rows="4" required>{{ $tip->tip_text }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Urutan Tampil</label>
                                                <input type="number" name="sort_order" class="form-control" value="{{ $tip->sort_order }}">
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
    {{ $tips->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.tips.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Tips Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Metode Pencucian</label>
                            <select name="method_code" class="form-select" required>
                                <option value="M1">M1 - Cuci tangan air dingin</option>
                                <option value="M2">M2 - Cuci tangan air hangat</option>
                                <option value="M3">M3 - Mesin cuci normal</option>
                                <option value="M4">M4 - Mesin cuci halus</option>
                                <option value="M5">M5 - Dry cleaning</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Jenis Kain (Filter)</label>
                            <select name="fabric_filter" class="form-select">
                                <option value="">- Semua Kain -</option>
                                @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                                <option value="{{ $f }}">{{ $f }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Warna (Filter)</label>
                            <select name="color_filter" class="form-select">
                                <option value="">- Semua Warna -</option>
                                @foreach(['Putih', 'Gelap', 'Terang/Cerah'] as $c)
                                <option value="{{ $c }}">{{ $c }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Motif (Filter)</label>
                            <select name="motif_filter" class="form-select">
                                <option value="">- Semua Motif -</option>
                                @foreach(['Polos', 'Batik', 'Sablon/Bordir'] as $m)
                                <option value="{{ $m }}">{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Isi Tips</label>
                            <textarea name="tip_text" class="form-control" rows="4" placeholder="Masukkan tips perawatan spesifik..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Urutan Tampil</label>
                            <input type="number" name="sort_order" class="form-control" value="0">
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Tips</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
