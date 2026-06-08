@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.articles.index') }}" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
    </a>
    <h4 class="fw-bold mt-2">{{ isset($article) ? 'Edit Artikel' : 'Tambah Artikel Baru' }}</h4>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Artikel</label>
                        <input type="text" name="title" class="form-control" value="{{ $article->title }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konten</label>
                        <textarea name="content" class="form-control" rows="15" required>{{ $article->content }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thumbnail (Upload)</label>
                        @if($article->thumbnail)
                        <div class="mb-2">
                            <img src="{{ asset($article->thumbnail) }}" class="rounded border" width="100%">
                        </div>
                        @endif
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengubah. Max: 2MB</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="draft" {{ $article->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ $article->status == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <div class="p-3 bg-light rounded-3">
                            @foreach($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat{{ $category->id }}"
                                    {{ $article->categories->contains($category->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="cat{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-4">
            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
