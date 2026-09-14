<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use Illuminate\Http\Request;

class AdminCurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();

        return view('admin.currency.index', compact('currencies'));
    }

    public function toggleStatus(Request $request, int $id)
    {
        $validated = $request->validate([
            'status' => 'required|in:active,inactive',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update(['status' => $validated['status']]);

        return response()->json([
            'success' => true,
            'message' => 'Status berhasil diupdate!',
            'currency' => $currency,
        ]);
    }
}
