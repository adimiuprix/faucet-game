<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            [
                'key' => 'sitename',
                'value' => 'GevFaucet',
            ],
            [
                'key' => 'description',
                'value' => 'Crypto Faucet',
            ],
            [
                'key' => 'keywords',
                'value' => 'crypto,faucet,earn,bitcoin,ethereum,litecoin,dogecoin,tron,xrp,stellar,cardano,polkadot,solana,avalanche,polygon,binance smart chain,tron,cardano,eos,neo,tron,cardano,eos,neo,tron,cardano,eos,neo',
            ],
            [
                'key' => 'commission',
                'value' => '50', //percentage
            ],
            [
                'key' => 'coinmarketcap_api',
                'value' => '9a911caea73045cfb6797c9a975fc175',
            ],
            [
                'key' => 'faucetpay_api',
                'value' => 'ertjeirjeirjei'
            ],
            [
                'key' => 'energy_cost',
                'value' => 1
            ],
            [
                'key' => 'faucet_chance',
                'value' => 1000
            ],
            [
                'key' => 'faucet_cooldown',
                'value' => 5
            ],
            [
                'key' => 'telegram_group',
                'value' => 'https://t.me/gevfaucet'
            ],
            [
                'key' => 'telegram_channel',
                'value' => 'https://t.me/gevfaucet'
            ]
        ];

        Setting::insert($settings);
    }
}
