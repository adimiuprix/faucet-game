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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'currencies' => 'required|array',
            'currencies.*' => 'required|exists:currencies,id',
        ]);

        // Reset semua currency menjadi inactive
        Currency::query()->update(['status' => 'inactive']);

        // Aktifkan currency yang dipilih
        Currency::whereIn('id', $validated['currencies'])->update(['status' => 'active']);

        return redirect()->route('admin.currency.index')
            ->with('success', 'Currency settings berhasil diupdate!');
    }
}
