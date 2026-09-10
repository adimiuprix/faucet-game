@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Mining Plans</h1>
    </div>
</div>

<div class="card p-4 border-light shadow-sm text-center">
    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Plan name</th>
                    <th>Energy Cost</th>
                    <th>Reward</th>
                    <th>Duration (day)</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($minings as $mining)
                <tr>
                    <td class="table-order-id">#{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $mining->plan_name }}</td>
                    <td class="table-amount">{{ $mining->cost }}</td>
                    <td class="table-amount">{{ $mining->reward }} {{ $mining->rewardCurrency->coin }}</td>
                    <td class="table-amount">{{ $mining->duration / 86400 }} days</td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="#" class="table-btn-action" title="View details"><i class="bi bi-eye"></i></a>
                            <a href="#" class="table-btn-action" title="Edit row"><i class="bi bi-pencil"></i></a>
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