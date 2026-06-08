@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Rekomendasi Deterjen</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.detergents.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari deterjen..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah Deterjen
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
                        <th>Kain</th>
                        <th>Nama Deterjen</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detergents as $det)
                    <tr>
                        <td class="ps-4"><span class="badge bg-navy">{{ $det->method_code }}</span></td>
                        <td>{{ $det->fabric ?? '-' }}</td>
                        <td class="fw-semibold">{{ $det->detergent_name }}</td>
                        <td><span class="badge bg-light text-primary border">{{ $det->detergent_type ?? '-' }}</span></td>
                        <td class="small text-muted">{{ Str::limit($det->description, 50) }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $det->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.detergents.destroy', $det->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus deterjen ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $det->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.detergents.update', $det->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Deterjen</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label">Metode</label>
                                            <select name="method_code" class="form-select" required>
                                                @foreach(['M1','M2','M3','M4','M5'] as $m)
                                                <option value="{{ $m }}" {{ $det->method_code == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jenis Kain</label>
                                            <select name="fabric" class="form-select">
                                                <option value="">- Semua Kain -</option>
                                                @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                                                <option value="{{ $f }}" {{ $det->fabric == $f ? 'selected' : '' }}>{{ $f }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Deterjen</label>
                                            <input type="text" name="detergent_name" class="form-control" value="{{ $det->detergent_name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tipe Deterjen</label>
                                            <input type="text" name="detergent_type" class="form-control" value="{{ $det->detergent_type }}" placeholder="Contoh: Cair, Bubuk, Gel">
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="2" required>{{ $det->description }}</textarea>
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
    {{ $detergents->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.detergents.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Deterjen Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Metode</label>
                        <select name="method_code" class="form-select" required>
                            <option value="M1">M1 - Cuci tangan air dingin</option>
                            <option value="M2">M2 - Cuci tangan air hangat</option>
                            <option value="M3">M3 - Mesin cuci normal</option>
                            <option value="M4">M4 - Mesin cuci halus</option>
                            <option value="M5">M5 - Dry cleaning</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kain</label>
                        <select name="fabric" class="form-select">
                            <option value="">- Semua Kain -</option>
                            @foreach(['Katun', 'Rayon', 'Denim', 'Linen', 'Poliester'] as $f)
                            <option value="{{ $f }}">{{ $f }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Deterjen</label>
                        <input type="text" name="detergent_name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tipe Deterjen</label>
                        <input type="text" name="detergent_type" class="form-control" placeholder="Contoh: Cair, Bubuk, Gel">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="2" required></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Deterjen</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
