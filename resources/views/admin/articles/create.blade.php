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
        <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Judul Artikel</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Konten</label>
                        <textarea name="content" class="form-control" rows="15" required>{{ old('content') }}</textarea>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thumbnail (Upload)</label>
                        <input type="file" name="thumbnail" class="form-control" accept="image/*">
                        <div class="form-text">Format: JPG, PNG, GIF. Max: 2MB</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select" required>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Kategori</label>
                        <div class="p-3 bg-light rounded-3">
                            @foreach($categories as $category)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" name="categories[]" value="{{ $category->id }}" id="cat{{ $category->id }}"
                                    {{ (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
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
                    Terbitkan Artikel
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
