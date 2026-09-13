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
                'coin' => 'BTC',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'btc.svg',
            ],
            [
                'coin' => 'ETH',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'eth.svg',
            ],
            [
                'coin' => 'DOGE',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'doge.svg',
            ],
            [
                'coin' => 'LTC',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'ltc.svg',
            ],
            [
                'coin' => 'BCH',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'bch.svg',
            ],
            [
                'coin' => 'DASH',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'dash.svg',
            ],
            [
                'coin' => 'DGB',
                'status' => 'inactive',
                'faucet_reward' => 0.00000010,
                'image' => 'dgb.svg',
            ],
            [
                'coin' => 'TRX',
                'status' => 'active',
                'faucet_reward' => 0.00000010,
                'image' => 'trx.svg',
            ],
            [
                'coin' => 'USDT',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'usdt.svg',
            ],
            [
                'coin' => 'FEY',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'fey.svg',
            ],
            [
                'coin' => 'ZEC',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'zec.svg',
            ],
            [
                'coin' => 'BNB',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'bnb.svg',
            ],
            [
                'coin' => 'SOL',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'sol.svg',
            ],
            [
                'coin' => 'XRP',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'xrp.svg',
            ],
            [
                'coin' => 'POL',
                'status' => 'active',
                'faucet_reward' => 0.00500000,
                'image' => 'pol.svg',
            ],
            [
                'coin' => 'ADA',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'ada.svg',
            ],
            [
                'coin' => 'TON',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'ton.svg',
            ],
            [
                'coin' => 'XLM',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'xlm.svg',
            ],
            [
                'coin' => 'USDC',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'usdc.svg',
            ],
            [
                'coin' => 'XMR',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'xmr.svg',
            ],
            [
                'coin' => 'TRUMP',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'trump.svg',
            ],
            [
                'coin' => 'PEPE',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'pepe.svg',
            ],
            [
                'coin' => 'FLT',
                'status' => 'inactive',
                'faucet_reward' => 0.00500000,
                'image' => 'flt.svg',
            ],
        ];

        Currency::insert($currencies);
    }
}
