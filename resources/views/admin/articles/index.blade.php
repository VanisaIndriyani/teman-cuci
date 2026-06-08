@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold m-0">Manajemen Artikel</h4>
    <div class="d-flex gap-3">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="d-flex gap-2">
            <input type="text" name="search" class="form-control rounded-pill px-3" placeholder="Cari artikel..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-light rounded-circle"><i class="bi bi-search"></i></button>
        </form>
        <a href="{{ route('admin.articles.create') }}" class="btn btn-primary rounded-pill px-4">
            <i class="bi bi-plus-lg me-2"></i> Tambah Artikel
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="ps-4">Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Views</th>
                        <th>Tanggal Dibuat</th>
                        <th class="text-end pe-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($articles as $article)
                    <tr>
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                @if($article->thumbnail)
                                <img src="{{ \Illuminate\Support\Str::startsWith($article->thumbnail, ['http://', 'https://']) ? $article->thumbnail : asset(ltrim($article->thumbnail, '/')) }}" class="rounded me-3" width="50" height="40" style="object-fit: cover;">
                                @else
                                <div class="bg-light rounded me-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                                    <i class="bi bi-image text-muted"></i>
                                </div>
                                @endif
                                <span class="fw-semibold">{{ $article->title }}</span>
                            </div>
                        </td>
                        <td>
                            @foreach($article->categories as $cat)
                            <span class="badge bg-light text-navy border">{{ $cat->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            @if($article->status == 'published')
                                <span class="badge bg-success-subtle text-success border border-success-subtle">Published</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle">Draft</span>
                            @endif
                        </td>
                        <td><i class="bi bi-eye me-1"></i> {{ $article->views }}</td>
                        <td class="small text-muted">{{ $article->created_at->format('d M Y') }}</td>
                        <td class="text-end pe-4">
                            <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-sm btn-light text-primary me-2">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger" onclick="return confirm('Hapus artikel ini?')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <i class="bi bi-journal-x display-4 d-block mb-3"></i>
                            Belum ada artikel yang dibuat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="mt-4 d-flex justify-content-center">
    {{ $articles->appends(request()->input())->links('pagination::bootstrap-5') }}
</div>
@endsection
