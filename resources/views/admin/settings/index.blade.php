@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <h4 class="fw-bold m-0">Pengaturan Aplikasi</h4>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf
                    @foreach($settings as $setting)
                    <div class="mb-4">
                        <label class="form-label fw-semibold">{{ ucfirst(str_replace('_', ' ', $setting->key)) }}</label>
                        @if($setting->key == 'about_us' || $setting->key == 'guide')
                        <textarea name="settings[{{ $setting->key }}]" class="form-control" rows="6">{{ $setting->value }}</textarea>
                        @else
                        <input type="text" name="settings[{{ $setting->key }}]" class="form-control" value="{{ $setting->value }}">
                        @endif
                    </div>
                    @endforeach
                    
                    <hr class="my-4">
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary rounded-pill px-5 py-2 fw-bold">
                            Simpan Semua Pengaturan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 bg-light">
            <div class="card-body p-4 text-center">
                <i class="bi bi-info-circle fs-1 text-primary mb-3"></i>
                <h5 class="fw-bold">Informasi</h5>
                <p class="text-muted small">Pengaturan ini akan langsung berdampak pada tampilan halaman publik (User) seperti footer, halaman tentang, dan halaman panduan.</p>
            </div>
        </div>
    </div>
</div>
@endsection
