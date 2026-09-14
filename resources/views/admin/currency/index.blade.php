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

<div class="card p-4 border-light shadow-sm text-center">
    <!-- Responsive Table Wrapper -->
    <div class="table-responsive">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Coin</th>
                    <th>Faucet Reward</th>
                    <th>Image</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($currencies as $currency)
                <tr>
                    <td class="table-order-id">#{{ $currency->id }}</td>
                    <td class="table-product-name">{{ ucfirst($currency->coin) }}</td>
                    <td class="table-amount">{{ number_format($currency->faucet_reward, 8) }}</td>
                    <td class="table-amount">
                        @if($currency->image)
                            <img src="{{ asset('coin/' . $currency->image) }}" alt="{{ $currency->coin }}" style="width: 30px; height: 30px; object-fit: cover;">
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="form-check form-switch d-inline-block">
                            <input class="form-switch-input-custom" 
                                   type="checkbox" 
                                   id="currency_status_{{ $currency->id }}"
                                   {{ $currency->status === 'active' ? 'checked' : '' }}
                                   onchange="toggleStatus({{ $currency->id }}, this.checked)">
                        </div>
                    </td>
                    <td>
                        <div class="d-flex justify-content-center gap-1">
                            <a href="#" class="table-btn-action" title="Edit row"><i class="bi bi-pencil"></i></a>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4">
                        <i class="bi bi-inbox" style="font-size: 3rem; color: #999;"></i>
                        <p class="text-muted mt-2">Tidak ada data currency.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<script>
function toggleStatus(currencyId, isActive) {
    const status = isActive ? 'active' : 'inactive';
    
    fetch(`/{{ config('admin.admin_prefix') }}/currency/${currencyId}/toggle`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ status: status })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Optional: show success message
            console.log('Status updated successfully');
        } else {
            // Revert toggle if failed
            document.getElementById(`currency_status_${currencyId}`).checked = !isActive;
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Revert toggle if error
        document.getElementById(`currency_status_${currencyId}`).checked = !isActive;
        alert('Error updating status');
    });
}
</script>

@endsection
