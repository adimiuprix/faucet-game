<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Captcha;

class AdminCaptchaController extends Controller
{
    public function index()
    {
        $captchas = Captcha::all();

        return view('admin.captcha.index', compact('captchas'));
    }
}
