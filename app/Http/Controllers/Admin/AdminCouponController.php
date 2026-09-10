<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class AdminCouponController extends Controller
{
    public function index(Request $request)
    {
        $coupons = Coupon::all();

        return view('admin.coupon.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupon.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'reward' => 'required',
            'energy' => 'required',
        ], [
            'code.unique' => 'That coupon code has already been used.',
        ]);

        Coupon::create([
            'code' => $request->input('code'),
            'reward' => $request->input('reward'),
            'energy_reward' => $request->input('energy'),
            'expired_at' => now()->addDay()
        ]);

        return redirect()->route('admin.coupon.index');
    }

    public function edit(int $id)
    {
        $coupon = Coupon::find($id);

        return view('admin.coupon.edit', compact('coupon'));
    }

    public function update(Request $request, int $id)
    {
        Coupon::findOrFail($id)->update([
            'code' => $request->input('code'),
            'reward' => $request->input('reward'),
            'energy_reward' => $request->input('energy'),
            'expired_at' => now()->addDay()
        ]);

        return redirect()->route('admin.coupon.index');
    }
}
