@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Create</h1>
    </div>
</div>

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="{{ route('admin.ptc.store') }}" method="post">
            <div class="mb-3">
                <label class="form-label-custom">Title</label>
                <input type="text" name="title" class="form-control-custom" placeholder="Enter Title" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Description</label>
                <input type="text" name="description" class="form-control-custom" placeholder="Enter Description" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Link Url</label>
                <input type="text" name="url" class="form-control-custom" placeholder="Enter Link Url" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Timer</label>
                <input type="number" name="timer" class="form-control-custom" placeholder="Enter Time in second" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">View Max</label>
                <input type="number" name="view_max" class="form-control-custom" placeholder="Enter Max View" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Status</label>
                <select class="form-select-custom" name="status">
                    <option selected disabled>Choose a type...</option>
                    <option value="active">Active</option>
                    <option value="paused">Paused</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="rejected">Rejected</option>
                    <option value="archived">Archived</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label-custom">Ad Type</label>
                <select class="form-select-custom" name="ad_type">
                    <option selected="" disabled="">Choose a type...</option>
                    <option value="website">Website</option>
                    <option value="youtube">Youtube</option>
                </select>
            </div>

            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection