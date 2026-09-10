<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Services\CoinMarketCapService;
use App\Services\FaucetPayService;
use App\Models\Currency;
use App\Models\Coupon;
use App\Models\CouponUsage;
use App\Models\Setting;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $telegramChannel = Setting::telegramChannel();
        $telegramGroup = Setting::telegramGroup();

        // Menampilkan daftar currerncy yang aktif menggunakan array 
        $currency = Currency::where('status', 'active')->where('coin', '!=', 'FEY')->pluck('coin', 'id')->toArray();
        
        return view('coupon', compact('currency', 'telegramChannel', 'telegramGroup'));
    }

    public function redeem(Request $request, CoinMarketCapService $cmc, FaucetPayService $faucetPay)
    {
        $user = Auth::user();
        
        // Validasi input
        $request->validate([
            'currency' => 'required',
            'code' => 'required',
        ]);

        // Ambil data input
        $currency = $request->currency;
        $currId = Currency::where('coin', $request->currency)->get()->value('id');

        $coupon = Coupon::where('code', $request->code)->first();

        // Cek apakah coupon ada
        if (!$coupon) {
            return redirect()->back()->with('error', 'Coupon not found');
        }

        // Cek apakah coupon sudah expired
        if ($coupon->expired_at < Carbon::now()) {
            return redirect()->back()->with('error', 'Coupon has expired');
        }

        // Cek apakah user sudah pernah menggunakan coupon ini
        $alreadyUsed = CouponUsage::where('user_id', $user->id)
            ->where('coupon_id', $coupon->id)
            ->exists();

        if ($alreadyUsed) {
            return redirect()->back()->with('error', 'You have already used this coupon');
        }

        try {
            // Mulai database transaction untuk memastikan data consistency
            DB::beginTransaction();

            // Conversi USD ke coin menggunakan nama coin
            $coinPrice = $cmc->usdToCoin($currency, $coupon->reward);

            // Update balance user
            DB::table('currency_users')
                ->where('user_id', $user->id)
                ->where('currency_id', $currId)
                ->increment('balance', $coinPrice);
            
            // Menambahkan energy ke user
            DB::table('users')
                ->where('id', $user->id)
                ->increment('energy', $coupon->energy_reward);

            // Catat penggunaan coupon ke tabel coupon_usages
            CouponUsage::create([
                'user_id' => $user->id,
                'coupon_id' => $coupon->id,
                'redeemed_at' => now(),
            ]);

            // kirim ke faucetpay
            $faucetPay->send($coinPrice, $currency, $user->email);

            // Commit transaction jika semua berhasil
            DB::commit();

            return redirect()->back()->with('success', 
                number_format($coinPrice, 8) . ' ' . $request->currency . 
                ' & ' . $coupon->energy_reward . ' energy has been added to your account!'
            );

        } catch (\Exception $e) {
            // Rollback jika ada error
            DB::rollBack();
            
            return redirect()->back()->with('error', 
                'Failed to redeem coupon. Please try again later.'
            );
        }
    }
}
