@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Create</h1>
    </div>
</div>

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="{{ route('admin.coupon.store') }}" method="post">
            <div class="mb-3">
                <label class="form-label-custom">Code</label>
                <input type="text" name="code" class="form-control-custom" placeholder="Enter Code" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Reward (USD)</label>
                <input type="number" step="any" name="reward" class="form-control-custom" placeholder="Enter Reward" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Energy</label>
                <input type="number" name="energy" class="form-control-custom" placeholder="Enter Amount Of Energy" />
            </div>
        
            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection