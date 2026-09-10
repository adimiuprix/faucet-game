<?php

namespace App\Console\Commands;

use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use App\Models\Setting;
use App\Models\User;

#[Signature('app:reset-claim-chance')]
#[Description('Command description')]
class ResetClaimChance extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        User::query()->update([
            'claim_chance' => Setting::faucetChance(),
        ]);

        return Command::SUCCESS;
    }
}
