@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Captcha</h1>
    </div>
</div>

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="" method="post">
            <div class="mb-3">
                <label class="form-label-custom">Provider</label>
                <input type="text" class="form-control-custom" placeholder="Enter Sitename" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Site Key</label>
                <input type="text" class="form-control-custom" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Secret Key</label>
                <input type="text" class="form-control-custom" placeholder="" />
            </div>

            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">Save</button>
            </div>
        </form>
    </div>
</div>


@endsection