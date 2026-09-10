<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Captcha;

class CaptchaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $captchas = [
            [
                'provider' => 'hcaptcha',
                'site_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxx',
                'secret_key' => 'xxxxxxxxxxxxxxxxxxxxxxxxxxx',
            ],
        ];

        Captcha::insert($captchas);
    }
}
