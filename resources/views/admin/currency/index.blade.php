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
                            <a href="#" 
                               class="table-btn-action" 
                               title="Edit row"
                               data-bs-toggle="modal" 
                               data-bs-target="#editModal"
                               onclick="openEditModal({{ $currency->id }}, '{{ $currency->coin }}', {{ $currency->faucet_reward }})">
                                <i class="bi bi-pencil"></i>
                            </a>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Faucet Reward</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_coin" class="form-label">Coin</label>
                        <input type="text" class="form-control" id="edit_coin" readonly>
                    </div>
                    
                    <div class="mb-3">
                        <label for="edit_faucet_reward" class="form-label">Faucet Reward <span class="text-danger">*</span></label>
                        <input type="number" 
                               class="form-control" 
                               name="faucet_reward"
                               id="edit_faucet_reward" 
                               step="0.00000001" 
                               min="0"
                               required
                               placeholder="0.00000000">
                        <small class="form-text text-muted">Format: hingga 8 desimal</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
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
            console.log('Status updated successfully');
        } else {
            document.getElementById(`currency_status_${currencyId}`).checked = !isActive;
            alert('Failed to update status');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        document.getElementById(`currency_status_${currencyId}`).checked = !isActive;
        alert('Error updating status');
    });
}

function openEditModal(currencyId, coin, faucetReward) {
    const form = document.getElementById('editForm');
    form.action = `/{{ config('admin.admin_prefix') }}/currency/${currencyId}/update-reward`;
    document.getElementById('edit_coin').value = coin;
    document.getElementById('edit_faucet_reward').value = faucetReward;
}
</script>

@endsection
