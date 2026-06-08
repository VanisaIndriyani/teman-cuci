@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Langkah-Langkah Pencucian</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.washing-steps.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari langkah..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah Langkah
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
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($steps as $step)
                    <tr>
                        <td class="ps-4">
                            <span class="badge bg-navy">{{ $step->method_code }}</span>
                        </td>
                        <td><span class="fw-bold">{{ $step->step_order }}</span></td>
                        <td>{{ $step->title }}</td>
                        <td>
                            <div class="small text-muted">{{ Str::limit($step->description, 50) }}</div>
                            @if($step->tip)
                                <div class="x-small text-primary mt-1"><i class="bi bi-lightbulb"></i> {{ Str::limit($step->tip, 30) }}</div>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $step->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.washing-steps.destroy', $step->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus langkah ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $step->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.washing-steps.update', $step->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit Langkah</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label">Metode</label>
                                            <select name="method_code" class="form-select" required>
                                                @foreach(['M1','M2','M3','M4','M5'] as $m)
                                                <option value="{{ $m }}" {{ $step->method_code == $m ? 'selected' : '' }}>{{ $m }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Nomor Langkah</label>
                                            <input type="number" name="step_order" class="form-control" value="{{ $step->step_order }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Judul Langkah</label>
                                            <input type="text" name="title" class="form-control" value="{{ $step->title }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Deskripsi</label>
                                            <textarea name="description" class="form-control" rows="3" required>{{ $step->description }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Tips (Opsional)</label>
                                            <textarea name="tip" class="form-control" rows="2">{{ $step->tip }}</textarea>
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
    {{ $steps->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.washing-steps.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah Langkah Baru</h5>
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
                        <label class="form-label">Nomor Langkah</label>
                        <input type="number" name="step_order" class="form-control" placeholder="Contoh: 1" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Judul Langkah</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Persiapan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Deskripsi langkah..." required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tips (Opsional)</label>
                        <textarea name="tip" class="form-control" rows="2" placeholder="Tips tambahan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah Langkah</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
