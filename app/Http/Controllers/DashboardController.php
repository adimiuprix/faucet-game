<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
        // Pastikan user sudah login
        if (! Auth::check()) {
            return redirect()->route('homepage');
        }

        $user = Auth::user();
        $energy = $user->getUserEnergy();
        $payments = Payment::latestPayments(10);

        $telegramChannel = Setting::telegramChannel();
        $telegramGroup = Setting::telegramGroup();

        return view('dashboard', compact('user', 'energy', 'payments', 'telegramChannel', 'telegramGroup'));
    }
}
