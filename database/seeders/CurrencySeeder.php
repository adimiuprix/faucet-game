<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Currency;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            [
                'coin' => 'FEY',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'fey.svg',
            ],
            [
                'coin' => 'USDT',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'usdt.svg',
            ],
            [
                'coin' => 'SOL',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'sol.svg',
            ],
        ];

        Currency::insert($currencies);
    }
}
