@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Paid To Click</h1>
    </div>
</div>

<div class="card p-4 border-light shadow-sm">

    <div class="table-header-control">
        <!-- Action buttons / Filter options -->
        <div class="table-filter-group">
            <button class="btn-table-action" type="button" onclick="window.location.href='{{ route('admin.ptc.create') }}'">
                <i class="bi bi-plus-square"></i> Create
            </button>
        </div>
    </div>

    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Url</th>
                    <th>Timer (s)</th>
                    <th>Total view</th>
                    <th>Max view</th>
                    <th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ptcAds as $ptc)
                <tr>
                    <td class="table-order-id">#{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $ptc->user->email }}</td>
                    <td class="table-amount">{{ $ptc->url }}</td>
                    <td class="table-amount">{{ $ptc->timer }}</td>
                    <td class="table-amount">{{ $ptc->total_views }}</td>
                    <td class="table-amount">{{ $ptc->view_max }}</td>
                    <td>
                        @php
                            $badgeClass = [
                                'active'   => 'success',
                                'completed' => 'success',
                                'pending'  => 'pending',
                                'paused'  => 'pending',
                                'rejected' => 'failed',
                                'archived' => 'failed',
                            ][$ptc->status] ?? 'pending';
                        @endphp
                        <span class="badge-table {{ $badgeClass }}">{{ $ptc->status }}</span>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.ptc.edit', $ptc->id) }}" class="table-btn-action" title="View details"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('admin.ptc.edit', $ptc->id) }}" class="table-btn-action" title="Edit row"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('admin.ptc.destroy', $ptc->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-btn-action delete" title="Delete row"><i class="bi bi-trash"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection