<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\FaucetClaim;
use App\Models\Payment;
use App\Models\Setting;
use App\Services\FaucetPayService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FaucetController extends Controller
{
    protected $timestamp;

    public function __construct()
    {
        $this->timestamp = Carbon::now()->timestamp;
    }

    public function index(string $coin)
    {
        $coin = strtoupper($coin);
        $user = Auth::user();

        $currency = Currency::firstWhere(['coin' => $coin, 'status' => 'active']);

        if (! $currency) {
            abort(404, 'Currency not found');
        }

        $balance = $user->getBalance($currency->id);

        $claimChance = $user->claim_chance;
        $faucetChance = Setting::faucetChance();

        $energy = $user->energy;

        $claimTimer = (int) Setting::faucetCooldown();

        $nextClaim = ($user->next_claim && $this->timestamp < $user->next_claim)
            ? $user->next_claim
            : null;

        return view('faucet', compact('coin', 'balance', 'claimChance', 'energy', 'faucetChance', 'claimTimer', 'nextClaim'));
    }

    public function verify(Request $request, FaucetPayService $faucetPay)
    {
        $user = Auth::user();

        // Validate request
        $coin = $request->validate(['currency' => 'required|string'])['currency'];

        // Get currency
        $currency = Currency::where('coin', $coin)
            ->where('status', 'active')
            ->first();

        if (! $currency) {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Currency not available or inactive. Please select a valid cryptocurrency.',
            ]);
        }

        // Get settings from database
        $energyRequired = Setting::energyCost();
        $cooldownMinutes = Setting::faucetCooldown();

        // Check if user has enough energy
        if ($user->energy < $energyRequired) {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Not enough energy to claim! You need '.$energyRequired.' energy, but you only have '.$user->energy.' energy.',
                'energy' => $user->energy,
                'required' => $energyRequired,
            ]);
        }

        // Check if user has enough chance to claim faucet, minimum 1 chance
        if ($user->claim_chance < 1) {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Not enough chance to claim! You need at least 1 chance to claim faucet.',
            ]);
        }

        // Check cooldown dari user->next_claim
        if ($user->next_claim && $this->timestamp < $user->next_claim) {
            $timeRemaining = $user->next_claim - $this->timestamp;
            $minutes = floor($timeRemaining / 60);
            $seconds = $timeRemaining % 60;

            return redirect()->back()->with([
                'success' => false,
                'message' => 'Please wait before claiming again! You can claim in '.$minutes.' minutes '.$seconds.' seconds.',
                'time_remaining' => $timeRemaining,
                'next_claim' => $user->next_claim,
            ]);
        }

        // Calculate reward
        $rewardAmount = $currency->faucet_reward ?? 0;

        if ($rewardAmount <= 0) {
            return redirect()->back()->with([
                'success' => false,
                'message' => 'Faucet reward has not been configured for '.$coin.'. Please contact support.',
            ]);
        }

        // Calculate next claim time
        $nextClaimTime = $this->timestamp + ($cooldownMinutes * 60);

        try {
            DB::beginTransaction();

            // Create faucet claim record
            $claim = FaucetClaim::create([
                'user_id' => $user->id,
                'currency_id' => $currency->id,
                'reward_amount' => $rewardAmount,
                'energy_used' => $energyRequired,
                'status' => FaucetClaim::STATUS_COMPLETED,
            ]);

            // Update user chance, dan next_claim
            $user->claim_chance = $user->claim_chance - 1;
            $user->next_claim = $nextClaimTime;
            $user->save();

            // Update user balance in currency_users pivot table
            $userCurrency = $user->currencies()
                ->where('currency_id', $currency->id)
                ->first();

            if ($userCurrency) {
                // Update existing balance
                $currentBalance = $userCurrency->pivot->balance;
                $newBalance = bcadd($currentBalance, $rewardAmount, 8);

                $user->currencies()->updateExistingPivot($currency->id, [
                    'balance' => $newBalance,
                ]);
            } else {
                // Attach currency with initial balance
                $user->currencies()->attach($currency->id, [
                    'balance' => $rewardAmount,
                ]);
            }

            $user->decrementEnergy(1);

            // kirim ke faucetpay
            $faucetPay->send($rewardAmount, $currency, $user->email);

            // insert payment setelah berhasil verify
            Payment::create([
                'user_id' => $user->id,
                'currency_id' => $currency->id,
                'amount' => $rewardAmount,
                'status' => 'success',
                'transaction_id' => $claim->id,
            ]);

            DB::commit();

            return redirect()->back()->with([
                'success' => true,
                'message' => '🎉 Congratulations! You have successfully claimed '.number_format($rewardAmount, 8).' '.$coin.'!',
                'reward_amount' => number_format($rewardAmount, 8),
                'currency' => $coin,
                'energy_remaining' => $user->energy,
                'energy_used' => $energyRequired,
                'next_claim' => $nextClaimTime,
                'cooldown_seconds' => $cooldownMinutes * 60,
                'claim_id' => $claim->id,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'success' => false,
                'message' => 'Oops! Something went wrong while processing your claim. Please try again in a few moments.',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ]);
        }
    }
}
