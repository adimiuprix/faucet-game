@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Edit</h1>
    </div>
</div>

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="{{ route('admin.ptc.update', $ptc->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label class="form-label-custom">Title</label>
                <input type="text" name="title" value="{{ $ptc->title }}" class="form-control-custom" placeholder="Enter Title" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Description</label>
                <input type="text" name="description" value="{{ $ptc->description }}" class="form-control-custom" placeholder="Enter Description" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Link Url</label>
                <input type="text" name="url" value="{{ $ptc->url }}" class="form-control-custom" placeholder="Enter Link Url" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Timer</label>
                <input type="number" name="timer" value="{{ $ptc->timer }}" class="form-control-custom" placeholder="Enter Time in second" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">View Max</label>
                <input type="number" name="view_max" value="{{ $ptc->view_max }}" class="form-control-custom" placeholder="Enter Max View" />
            </div>

            <div class="mb-3">
                <label class="form-label-custom">Status</label>
                <select class="form-select-custom" name="status">
                    <option selected disabled>Choose a type...</option>
                    <option value="active" {{ $ptc->status === 'active' ? 'selected' : '' }}>Active</option>
                    <option value="paused" {{ $ptc->status === 'paused' ? 'selected' : '' }}>Paused</option>
                    <option value="pending" {{ $ptc->status === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="completed" {{ $ptc->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="rejected" {{ $ptc->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    <option value="archived" {{ $ptc->status === 'archived' ? 'selected' : '' }}>Archived</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label class="form-label-custom">Ad Type</label>
                <select class="form-select-custom" name="ad_type">
                    <option selected disabled>Choose a type...</option>
                    <option value="website" {{ $ptc->ad_type === 'website' ? 'selected' : '' }}>Website</option>
                    <option value="youtube" {{ $ptc->ad_type === 'youtube' ? 'selected' : '' }}>Youtube</option>
                </select>
            </div>
        
            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">Create</button>
            </div>
        </form>
    </div>
</div>

@endsection