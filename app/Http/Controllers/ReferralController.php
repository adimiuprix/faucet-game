<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;

class ReferralController extends Controller
{
    public function index()
    {
        $commission = Setting::commission();
        $referralUrl = url('/?ref=' . auth()->user()->unique_id);
        $downlines = User::where('referred_by', auth()->user()->id)->get();
        $refCount = $downlines->count();

        return view('referrals', compact('commission', 'referralUrl', 'downlines', 'refCount'));
    }
}
