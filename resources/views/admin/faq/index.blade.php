@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Manajemen FAQ</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.faq.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari FAQ..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <button class="btn btn-primary rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#addModal">
            <i class="bi bi-plus-lg me-2"></i> Tambah FAQ
        </button>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">No. Urut</th>
                        <th>Pertanyaan</th>
                        <th>Jawaban</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($faqs as $faq)
                    <tr>
                        <td class="ps-4 fw-bold text-muted">{{ $faq->sort_order }}</td>
                        <td class="fw-semibold">{{ $faq->question }}</td>
                        <td class="small text-muted">{{ Str::limit($faq->answer, 100) }}</td>
                        <td class="text-end pe-4">
                            <button class="btn btn-sm btn-light text-primary me-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $faq->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.faq.destroy', $faq->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus FAQ ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>

                    <!-- Edit Modal -->
                    <div class="modal fade" id="editModal{{ $faq->id }}" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content rounded-4 border-0">
                                <form action="{{ route('admin.faq.update', $faq->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <div class="modal-header border-0 pb-0">
                                        <h5 class="fw-bold">Edit FAQ</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="mb-3">
                                            <label class="form-label">Pertanyaan</label>
                                            <input type="text" name="question" class="form-control" value="{{ $faq->question }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Jawaban</label>
                                            <textarea name="answer" class="form-control" rows="4" required>{{ $faq->answer }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">No. Urut Tampil</label>
                                            <input type="number" name="sort_order" class="form-control" value="{{ $faq->sort_order }}" required>
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
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-question-circle display-4 d-block mb-3"></i>
                            Belum ada FAQ yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $faqs->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('admin.faq.store') }}" method="POST">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="fw-bold">Tambah FAQ Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label">Pertanyaan</label>
                        <input type="text" name="question" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jawaban</label>
                        <textarea name="answer" class="form-control" rows="4" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">No. Urut Tampil</label>
                        <input type="number" name="order" class="form-control" value="1" required>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4">Tambah FAQ</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
