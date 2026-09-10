<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaucetClaim;

class AdminFaucetController extends Controller
{
    public function index()
    {
        $faucet_claims = FaucetClaim::latest()->with(['user', 'currency'])->paginate(10);

        return view('admin.faucet.index', compact('faucet_claims'));
    }
}
