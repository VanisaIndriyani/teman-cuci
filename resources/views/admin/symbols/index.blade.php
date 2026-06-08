@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Simbol Perawatan (Care Symbols)</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.symbols.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari simbol..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah Simbol
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Simbol</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($symbols as $symbol)
                    <tr>
                        <td class="ps-4">
                            <div class="bg-light p-2 rounded d-inline-block">
                                <img src="{{ $symbol->image_path }}" width="30" height="30" alt="{{ $symbol->name }}">
                            </div>
                        </td>
                        <td class="fw-semibold">{{ $symbol->name }}</td>
                        <td><span class="badge bg-light text-navy border">{{ $symbol->category->name }}</span></td>
                        <td class="small text-muted">{{ Str::limit($symbol->description_short, 50) }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $symbol->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.symbols.destroy', $symbol->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus simbol ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $symbol->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.symbols.update', $symbol->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Simbol</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label">Kategori</label>
                                            <select name="category_id" class="form-select" required>
                                                @foreach($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ $symbol->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nama Simbol</label>
                                            <input type="text" name="name" class="form-control" value="{{ $symbol->name }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">URL Gambar/Icon</label>
                                            <input type="text" name="image_path" class="form-control" value="{{ $symbol->image_path }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Singkat</label>
                                            <textarea name="description_short" class="form-control" rows="2" required>{{ $symbol->description_short }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi Lengkap (Opsional)</label>
                                            <textarea name="description_long" class="form-control" rows="3">{{ $symbol->description_long }}</textarea>
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
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-tags display-4 d-block mb-3"></i>
                            Belum ada simbol care.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $symbols->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.symbols.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Simbol Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select name="category_id" class="form-select" required>
                            @foreach($categories as $cat)
                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Simbol</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">URL Gambar/Icon</label>
                        <input type="text" name="image_path" class="form-control" placeholder="https://..." required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Singkat</label>
                        <textarea name="description_short" class="form-control" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi Lengkap (Opsional)</label>
                        <textarea name="description_long" class="form-control" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Simbol</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
