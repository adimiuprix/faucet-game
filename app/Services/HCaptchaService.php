<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Captcha;

class HCaptchaService
{
    function verifyToken(string $token, string $ip = null): array
    {
        $captcha = Captcha::first();

        $response = Http::asForm()
            ->timeout(5)
            ->post('https://api.hcaptcha.com/siteverify', [
                'secret'   => $captcha->getSecretKey(),
                'response' => $token,
                'remoteip' => $ip,
                'sitekey'  => $captcha->getSiteKey(),
            ])
            ->json();

        return !empty($response['success'])
            ? [true, []]
            : [false, $response['error-codes'] ?? []];
    }
}