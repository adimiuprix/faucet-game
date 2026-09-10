@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Users</h1>
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
                    <th>Energy</th>
                    <th>Claim Chance</th>
                    <th>Ref Id</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td class="table-order-id">#{{ $loop->iteration }}</td>
                    <td class="table-product-name">{{ $user->email }}</td>
                    <td class="table-amount">{{ $user->email }}</td>
                    <td class="table-amount">150</td>
                    <td class="table-amount">5786455</td>
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