<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Captcha;
use Illuminate\Http\Request;

class AdminCaptchaController extends Controller
{
    public function index()
    {
        $captcha = Captcha::first();

        return view('admin.captcha.index', compact('captcha'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'provider' => 'required|in:hcaptcha,recaptcha,cloudflare',
            'site_key' => 'required|string|max:255',
            'secret_key' => 'required|string|max:255',
        ]);

        // Cek apakah sudah ada data captcha
        $captcha = Captcha::first();

        if ($captcha) {
            // Update data yang sudah ada
            $captcha->update($validated);
            $message = 'Captcha successfully updated!';
        } else {
            // Buat data baru
            Captcha::create($validated);
            $message = 'Captcha successfully saved!';
        }

        return redirect()->route('admin.captcha.index')
            ->with('success', $message);
    }
}
