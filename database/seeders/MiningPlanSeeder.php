<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MiningPlan;

class MiningPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'plan_name' => 'Bronze',
                'cost' => 1000,
                'cost_unit' => 'Energy',
                'reward' => 0.263158,
                'reward_currency_id' => 1,
                'duration' => 86400,
            ],
            [
                'plan_name' => 'Silver',
                'cost' => 2000,
                'cost_unit' => 'Energy',
                'reward' => 0.526316,
                'reward_currency_id' => 1,
                'duration' => 86400,
            ],
        ];

        MiningPlan::insert($plans);
    }
}
