<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\PtcAd;
use App\Models\PtcAdClick;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SurfAdController extends Controller
{
    public function index(string $coin)
    {
        $coin = strtoupper($coin);
        $user = Auth::user();

        $currency = Currency::firstWhere(['coin' => $coin, 'status' => 'active']);

        if (! $currency) {
            abort(404, 'Currency not found');
        }

        $balance = $user->getBalance($currency->id);
        $energy = $user->getUserEnergy();

        // Get active ads that have reward configuration for this coin
        // and have not been completed by the user today (globally across any currency)
        $completedTodayAdIds = PtcAdClick::where('user_id', $user->id)
            ->where('status', PtcAdClick::STATUS_COMPLETED)
            ->whereDate('created_at', today())
            ->pluck('ptc_ad_id')
            ->toArray();

        $ads = PtcAd::active()
            ->whereNotIn('id', $completedTodayAdIds)
            ->whereHas('rewards', function ($q) use ($currency) {
                $q->where('currency_id', $currency->id)
                    ->where('reward', '>', 0);
            })
            ->with(['rewards' => function ($q) use ($currency) {
                $q->where('currency_id', $currency->id);
            }])
            ->get();

        $totalAvailable = $ads->count();
        $totalReward = $ads->sum(function ($ad) {
            return $ad->rewards->first()->reward ?? 0;
        });

        return view('ptc', compact(
            'coin',
            'currency',
            'balance',
            'energy',
            'ads',
            'totalAvailable',
            'totalReward'
        ));
    }

    public function start(Request $request, string $coin, int $id)
    {
        $coin = strtoupper($coin);
        $user = Auth::user();

        if ($user->energy < 1) {
            return redirect()->back()->with('error', 'Not enough energy! Please refill your energy.');
        }

        $currency = Currency::firstWhere(['coin' => $coin, 'status' => 'active']);
        if (! $currency) {
            return redirect()->route('dashboard')->with('error', 'Currency not found');
        }

        $ad = PtcAd::active()->find($id);
        if (! $ad) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'Ad is not available or inactive');
        }

        $rewardConfig = $ad->rewardForCurrency($currency->id);
        if (! $rewardConfig || $rewardConfig->reward <= 0) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'Reward not configured for this coin');
        }

        // Check if already completed today globally in any currency
        $alreadyClaimed = PtcAdClick::where('user_id', $user->id)
            ->where('ptc_ad_id', $ad->id)
            ->where('status', PtcAdClick::STATUS_COMPLETED)
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyClaimed) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'You have already visited this ad today');
        }

        // Record/Create click session with pending status
        PtcAdClick::create([
            'ptc_ad_id' => $ad->id,
            'user_id' => $user->id,
            'currency_id' => $currency->id,
            'reward' => $rewardConfig->reward,
            'status' => PtcAdClick::STATUS_PENDING,
            'clicked_at' => now(),
        ]);

        $reward = $rewardConfig->reward;

        return view('ptc-surf', compact('ad', 'coin', 'currency', 'reward'));
    }

    public function verify(Request $request, string $coin, int $id)
    {
        $coin = strtoupper($coin);
        $user = Auth::user();

        $currency = Currency::firstWhere(['coin' => $coin, 'status' => 'active']);
        if (! $currency) {
            return redirect()->route('dashboard')->with('error', 'Currency not found');
        }

        $ad = PtcAd::active()->find($id);
        if (! $ad) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'Ad not found or inactive');
        }

        $rewardConfig = $ad->rewardForCurrency($currency->id);
        if (! $rewardConfig || $rewardConfig->reward <= 0) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'Reward not configured');
        }

        // Get the latest pending click session
        $click = PtcAdClick::where('user_id', $user->id)
            ->where('ptc_ad_id', $ad->id)
            ->where('currency_id', $currency->id)
            ->where('status', PtcAdClick::STATUS_PENDING)
            ->latest('id')
            ->first();

        // Check if already completed today globally
        $alreadyClaimed = PtcAdClick::where('user_id', $user->id)
            ->where('ptc_ad_id', $ad->id)
            ->where('status', PtcAdClick::STATUS_COMPLETED)
            ->whereDate('created_at', today())
            ->exists();

        if ($alreadyClaimed) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'You have already claimed this ad reward today');
        }

        if (! $click) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'No active visit session found');
        }

        // Validate timer duration using raw unix timestamp
        $clickedTime = $click->clicked_at ? $click->clicked_at->timestamp : $click->created_at->timestamp;
        $secondsPassed = time() - $clickedTime;

        // Allow 2 seconds tolerance for network latency
        $requiredTimer = max(1, $ad->timer - 2);

        if ($secondsPassed < $requiredTimer) {
            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'You did not view the ad for the required time. ('.$secondsPassed.'s / '.$ad->timer.'s elapsed)');
        }

        try {
            DB::beginTransaction();

            // Update click status
            $click->status = PtcAdClick::STATUS_COMPLETED;
            $click->completed_at = now();
            $click->save();

            // Increment ad total views
            $ad->increment('total_views');

            // Increment spent reward budget
            $rewardConfig->increment('spent', $rewardConfig->reward);

            // Update user currency balance
            $userCurrency = $user->currencies()
                ->where('currency_id', $currency->id)
                ->first();

            // Update decrement energy
            $user->decrementEnergy(1);

            if ($userCurrency) {
                $currentBalance = $userCurrency->pivot->balance;
                $newBalance = bcadd($currentBalance, $rewardConfig->reward, 8);
                $user->currencies()->updateExistingPivot($currency->id, [
                    'balance' => $newBalance,
                ]);
            } else {
                $user->currencies()->attach($currency->id, [
                    'balance' => $rewardConfig->reward,
                ]);
            }

            DB::commit();

            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('success', '🎉 You earned '.number_format($rewardConfig->reward, 8).' '.$coin.'!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->route('ptc', ['coin' => strtolower($coin)])->with('error', 'An error occurred while claiming your reward.');
        }
    }
}
