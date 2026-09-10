@extends('admin.layout')

@section('content')

<div class="page-header">
    <div>
        <h1 class="page-title">Settings</h1>
    </div>
</div>

<div class="col-12 col-lg-12">
    <div class="card border-light shadow-sm p-4 h-100">
        <form action="{{ route('admin.setting.update') }}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label-custom">Sitename</label>
                <input type="text" class="form-control-custom" name="sitename" value="{{ $setting['sitename'] }}" placeholder="Enter Sitename" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Description</label>
                <input type="text" class="form-control-custom" name="description" value="{{ $setting['description'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Keywords</label>
                <input type="text" class="form-control-custom" name="keywords" value="{{ $setting['keywords'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Commission (%)</label>
                <input type="number" class="form-control-custom" name="commission" value="{{ $setting['commission'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Coinmarketcap Api</label>
                <input type="text" class="form-control-custom" name="cmc_api" value="{{ $setting['coinmarketcap_api'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Faucetpay Api</label>
                <input type="text" class="form-control-custom" name="faucetpay_api" value="{{ $setting['faucetpay_api'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Energy Cost</label>
                <input type="number" class="form-control-custom" name="energy" value="{{ $setting['energy_cost'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Faucet Chance</label>
                <input type="number" class="form-control-custom" name="chance" value="{{ $setting['faucet_chance'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Faucet Cooldown</label>
                <input type="number" class="form-control-custom" name="faucet_cooldown" value="{{ $setting['faucet_cooldown'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Telegram Channel</label>
                <input type="text" class="form-control-custom" name="tg_channel" value="{{ $setting['telegram_channel'] }}" placeholder="" />
            </div>
    
            <div class="mb-3">
                <label class="form-label-custom">Telegram Group</label>
                <input type="text" class="form-control-custom" name="tg_group" value="{{ $setting['telegram_group'] }}" placeholder="" />
            </div>
    
            <div class="text-center">
                <button type="submit" class="btn-custom btn-custom-secondary">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection