@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Faucet</h1>
    </div>
</div>

<div class="card p-4 border-light shadow-sm text-center">
    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Reward</th>
                    <th>Energy Used</th>
                    <th>Status</th>
                    <th>Claim time</th>
                </tr>
            </thead>
            <tbody>
                @foreach($faucet_claims as $fclaim)
                <tr>
                    <td class="table-order-id">#{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $fclaim->user->email }}</td>
                    <td class="table-amount">{{ $fclaim->reward_amount }} {{ $fclaim->currency->coin }}</td>
                    <td class="table-amount">{{ $fclaim->energy_used }}</td>
                    <td><span class="badge-table success">{{ $fclaim->status }}</span></td>
                    <td class="table-amount">{{ $fclaim->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-4 d-flex justify-content-center">
        {{ $faucet_claims->links() }}
    </div>
</div>

@endsection