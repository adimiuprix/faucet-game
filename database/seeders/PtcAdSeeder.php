<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PtcAd;
use App\Models\PtcAdReward;
use App\Models\Currency;
use App\Models\User;

class PtcAdSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();
        if (!$admin) {
            $admin = User::create([
                'unique_id' => 10001,
                'email'     => 'admin@gardecet.local',
                'energy'    => 1000,
                'balance'   => 100,
            ]);
        }

        $currencies = Currency::all();

        $sampleAds = [
            [
                'title'       => 'CryptoEarns Instant Faucet',
                'description' => 'Claim Free Crypto Instant and fast withdraw to FaucetPay!',
                'url'         => 'https://google.com',
                'timer'       => 7,
                'view_max'    => 1000,
                'status'      => 'active',
            ],
            [
                'title'       => 'Instant KiddyEarner Faucet',
                'description' => 'Fast fun trusted amazing direct faucet pays to FaucetPay',
                'url'         => 'https://google.com',
                'timer'       => 10,
                'view_max'    => 1000,
                'status'      => 'active',
            ],
            [
                'title'       => 'Join Now Claim Big Crypto!',
                'description' => 'Five ways to earn, 20% referral for life, instant cashout.',
                'url'         => 'https://google.com',
                'timer'       => 5,
                'view_max'    => 1000,
                'status'      => 'active',
            ],
        ];

        foreach ($sampleAds as $adData) {
            $ad = PtcAd::create(array_merge($adData, [
                'user_id' => $admin->id,
            ]));

            foreach ($currencies as $currency) {
                // Reward proporsional berdasarkan coin
                $reward = match (strtoupper($currency->coin)) {
                    'SOL'  => 0.00000500,
                    'USDT' => 0.00050000,
                    'FEY'  => 0.05000000,
                    default => 0.00001000,
                };

                PtcAdReward::create([
                    'ptc_ad_id'   => $ad->id,
                    'currency_id' => $currency->id,
                    'reward'      => $reward,
                    'budget'      => $reward * 1000,
                    'spent'       => 0,
                ]);
            }
        }
    }
}
