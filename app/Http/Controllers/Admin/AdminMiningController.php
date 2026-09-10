<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MiningPlan;

class AdminMiningController extends Controller
{
    public function index()
    {
        $minings = MiningPlan::with(['rewardCurrency'])->get();

        return view('admin.mining.index', compact('minings'));
    }
}
