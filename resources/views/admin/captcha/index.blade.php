@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Captcha Settings</h1>
    </div>
</div>

@if(session('success'))
<div class="alert-custom alert-custom-success" role="alert">
    <i class="bi bi-check-circle-fill alert-custom-icon"></i>
    <div class="alert-custom-content">
        {{ session('success') }}
    </div>
    <button class="alert-custom-close" type="button" aria-label="Close" onclick="this.parentElement.remove();">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
@endif

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="{{ route('admin.captcha.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="form-label-custom">Provider <span class="text-danger">*</span></label>
                <select class="form-select-custom @error('provider') is-invalid @enderror" name="provider" required>
                    <option value="" disabled {{ !$captcha ? 'selected' : '' }}>Pilih Provider...</option>
                    <option value="hcaptcha" {{ old('provider', $captcha?->provider) === 'hcaptcha' ? 'selected' : '' }}>hCaptcha</option>
                </select>
                @error('provider')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Site Key <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control-custom @error('site_key') is-invalid @enderror" 
                       name="site_key"
                       value="{{ old('site_key', $captcha?->site_key) }}"
                       placeholder="Masukkan Site Key" 
                       required />
                @error('site_key')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Site Key dari provider captcha Anda</small>
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Secret Key <span class="text-danger">*</span></label>
                <input type="text" 
                       class="form-control-custom @error('secret_key') is-invalid @enderror" 
                       name="secret_key"
                       value="{{ old('secret_key', $captcha?->secret_key) }}"
                       placeholder="Masukkan Secret Key" 
                       required />
                @error('secret_key')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">Secret Key dari provider captcha Anda</small>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
