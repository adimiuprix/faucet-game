@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Coupon</h1>
    </div>
</div>


<div class="card p-4 border-light shadow-sm">

    <div class="table-header-control">
        <!-- Action buttons / Filter options -->
        <div class="table-filter-group">
            <button class="btn-table-action" type="button" onclick="window.location.href='{{ route('admin.coupon.create') }}'">
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
                    <th>Code</th>
                    <th>Reward (USD)</th>
                    <th>Energy Reward</th>
                    <th>Expire At</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($coupons as $coupon)
                <tr>
                    <td class="table-order-id">#{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $coupon->code }}</td>
                    <td class="table-amount">${{ $coupon->reward }}</td>
                    <td class="table-amount">{{ $coupon->energy_reward }}</td>
                    <td>{{ $coupon->expired_at }}</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="{{ route('admin.coupon.edit', $coupon->id) }}" class="table-btn-action" title="Edit row"><i class="bi bi-pencil"></i></a>
                            <a href="#" class="table-btn-action delete" title="Delete row"
                                ><i class="bi bi-trash"></i
                            ></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

@endsection