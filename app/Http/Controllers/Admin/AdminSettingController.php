<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    public function index()
    {
        $setting = Setting::pluck('value', 'key');

        return view('admin.setting.index', compact('setting'));
    }

    public function update(Request $request)
    {
        foreach ($request->except('_token', '_method') as $key => $value) {
            Setting::where('key', $key)->update([
                'value' => $value,
            ]);
        }

        return redirect()
            ->back()
            ->with('success', 'Settings berhasil diperbarui.');
    }
}
