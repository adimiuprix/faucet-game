<?php

namespace App\Http\Controllers;

use App\Models\MiningPlan;
use App\Models\UserMining;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Exception;

class MiningController extends Controller
{
    public function index()
    {
        $this->sync();

        $user = Auth::user();
        $plans = MiningPlan::all();
        $energy = $user->energy;
        $user_mining = $user->userMinings()->where('is_claimed', false)->get();
        $miner = $user_mining->where('status', UserMining::STATUS_PROCESS)->count();

        return view('mining', compact('energy', 'miner', 'plans', 'user_mining'));
    }

    public function buy(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:mining_plans,id',
        ]);

        $plan = MiningPlan::findOrFail($validated['plan_id']);
        $user = Auth::user();

        // Cek apakah user punya energy yang cukup untuk membayar
        if ($user->getUserEnergy() < $plan->cost) {
            return redirect()->back()->with('error', 'Not enough energy! You need '.$plan->cost.' energy, but you only have '.$user->energy.' energy.');
        }

        // Cek apakah user sudah punya mining yang sama dan masih aktif
        $existingMining = $user->userMinings()
            ->where('plan_id', $plan->id)
            ->where('status', UserMining::STATUS_PROCESS)
            ->first();

        if ($existingMining) {
            $remainingTime = max(0, $existingMining->claim_time - time());
            $hours = floor($remainingTime / 3600);
            $minutes = floor(($remainingTime % 3600) / 60);

            return redirect()->back()->with('error', 'You already have an active mining plan: '.$plan->plan_name.'. Wait '.$hours.'h '.$minutes.'m to claim it.');
        }

        try {
            DB::beginTransaction();

            // Kurangi energy
            $user->decrementEnergy($plan->cost);

            // Tambah mining
            $user->userMinings()->create([
                'plan_id' => $plan->id,
                'claim_time' => time() + $plan->duration, // Unix timestamp
                'status' => UserMining::STATUS_PROCESS,
            ]);

            DB::commit();

            return redirect()->back()->with('success', '🎉 Mining plan "'.$plan->plan_name.'" activated successfully! You will be able to claim in '.($plan->duration / 3600).' hours.');

        } catch (Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Oops! Something went wrong while activating your mining plan. Please try again.');
        }
    }

    public function claim(Request $request)
    {
        $validated = $request->validate([
            'mining_id' => 'required|exists:user_minings,id',
        ]);

        $user = Auth::user();
        $mining = UserMining::with('plan.rewardCurrency')->findOrFail($validated['mining_id']);

        DB::beginTransaction();

        $plan = $mining->plan;
        $currency = $plan->rewardCurrency;
        $rewardAmount = $plan->reward;

        // Increment user balance dynamically
        $user->incrementBalance($currency->id, $rewardAmount);

        // update is_claimed jadi true
        $mining->update(['is_claimed' => true]);

        DB::commit();

        return redirect()->back()->with('success', '🎉 Mining claimed successfully! You received '.number_format($rewardAmount, 8).' '.$currency->coin.'!');
    }

    public function sync(): void
    {
        UserMining::where('status', UserMining::STATUS_PROCESS)
            ->where('claim_time', '<=', time())
            ->update(['status' => UserMining::STATUS_ENDED]);
    }
}
