@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Currency Setting</h1>
    </div>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card p-4 border-light shadow-sm">
    <h6 class="mb-4">Select Coin</h6>

    <form action="{{ route('admin.currency.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-4">
            @php
                $halfCount = ceil($currencies->count() / 2);
                $leftColumn = $currencies->take($halfCount);
                $rightColumn = $currencies->skip($halfCount);
            @endphp

            <!-- Kolom Kiri -->
            <div class="col-12 col-md-6">
                @foreach($leftColumn as $currency)
                <div class="form-switch-custom">
                    <input class="form-switch-input-custom" 
                           type="checkbox" 
                           name="currencies[]"
                           value="{{ $currency->id }}"
                           id="currency_{{ $currency->id }}"
                           {{ $currency->status === 'active' ? 'checked' : '' }}>
                    <label class="form-switch-label" for="currency_{{ $currency->id }}">
                        {{ ucfirst($currency->coin) }}
                    </label>
                </div>
                @endforeach
            </div>

            <!-- Kolom Kanan -->
            <div class="col-12 col-md-6">
                @foreach($rightColumn as $currency)
                <div class="form-switch-custom">
                    <input class="form-switch-input-custom" type="checkbox" name="currencies[]" value="{{ $currency->id }}" id="currency_{{ $currency->id }}" {{ $currency->status === 'active' ? 'checked' : '' }}>
                    <label class="form-switch-label" for="currency_{{ $currency->id }}">
                        {{ ucfirst($currency->coin) }}
                    </label>
                </div>
                @endforeach
            </div>
        </div>

        @if($currencies->isEmpty())
        <div class="text-center py-4">
            <i class="fas fa-coins fa-3x text-muted mb-3"></i>
            <p class="text-muted">There are no currencies yet. Please add a currency first.</p>
        </div>
        @endif

        <div class="text-center mt-4">
            <button type="submit" class="btn-custom btn-custom-secondary">
                <i class="fas fa-save me-2"></i>Save Changes
            </button>
        </div>
    </form>
</div>

@endsection