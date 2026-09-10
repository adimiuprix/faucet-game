<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Faq;
use App\Models\Payment;
use App\Models\User;
use App\Services\HCaptchaService;
use App\Services\FaucetPayService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Tangkap query parameter ref jika ada dan tidak null, jika ada simpan ke storage
        $ref = $request->query('ref');
        if ($ref) {
            $user = User::where('unique_id', $ref)->first();
            if ($user) {
                session()->put('ref', $user->id);
            }
        }

        // Jika sudah login, redirect ke dashboard
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        // ambil semua data payment yang status nya success
        $payments = Payment::latestPayments(10);
        $faqs = Faq::all();

        return view('home', compact('payments', 'faqs'));
    }

    public function auth_process(Request $request, HCaptchaService $hcaptcha, FaucetPayService $faucetPay)
    {
        // Validasi input email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $email = $request->input('email');

        // verify the email with faucetpay
        $verifyResult = $faucetPay->verify($email);
        if (($verifyResult['success']) === false) {
            return redirect()->back()->with('error', $verifyResult['message']);
        }

        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'unique_id' => $this->generateUniqueId(),
                'energy' => 0,
                'referred_by' => 0,
                'balance' => 0,
                'claim_chance' => 0,
                'next_claim' => null,
            ]
        );

        // Jika user baru dibuat, tambahkan semua currency dengan balance 0
        if ($user->wasRecentlyCreated) {
            $currencies = Currency::all();

            foreach ($currencies as $currency) {
                $user->currencies()->attach($currency->id, [
                    'balance' => 0,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Jika ada session ref (upline), simpan ke referred_by
            $uplineId = session('ref');
            if ($uplineId && $uplineId !== $user->id) {
                $user->referred_by = $uplineId;
                $user->save();
                session()->forget('ref');
            }
        }

        // Login user
        Auth::login($user, true); // true = remember me
        $request->session()->regenerate();

        // Redirect ke dashboard
        return redirect()->route('dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('homepage');
    }

    // Generate unique ID untuk user baru
    private function generateUniqueId()
    {
        do {
            $uniqueId = rand(1000000, 9999999);
        } while (User::where('unique_id', $uniqueId)->exists());

        return $uniqueId;
    }
}
