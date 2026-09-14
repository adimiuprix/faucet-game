<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PtcAd;
use Illuminate\Http\Request;

class AdminPtcController extends Controller
{
    public function index()
    {
        $ptcAds = PtcAd::paginate(10);

        return view('admin.ptc.index', compact('ptcAds'));
    }

    public function create()
    {
        return view('admin.ptc.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required',
            'timer' => 'required',
            'view_max' => 'required',
            'ad_type' => 'required',
        ]);

        PtcAd::create([
            'user_id' => 1,
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'timer' => $request->input('timer'),
            'view_max' => $request->input('view_max'),
            'total_views' => 0,
            'status' => 'active',
            'ad_type' => $request->input('ad_type'),
            'starts_at' => now(),
            'ends_at' => now()->addDays(30),
        ]);

        return redirect()->route('admin.ptc.index')
            ->with('success', 'PTC Ad created successfully.');
    }

    public function edit(int $id)
    {
        $ptc = PtcAd::findOrFail($id);

        return view('admin.ptc.edit', compact('ptc'));
    }

    public function update(Request $request, int $id)
    {
        PtcAd::findOrFail($id)->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'url' => $request->input('url'),
            'timer' => $request->input('timer'),
            'view_max' => $request->input('view_max'),
            'status' => $request->input('status'),
            'ad_type' => $request->input('ad_type'),
        ]);

        return redirect()->route('admin.ptc.index')
            ->with('success', 'PTC Ad updated successfully.');
    }

    public function destroy(int $id)
    {
        $ptcAd = PtcAd::findOrFail($id);
        $ptcAd->delete();

        return redirect()->route('admin.ptc.index')
            ->with('success', 'PTC Ad deleted successfully.');
    }
}
