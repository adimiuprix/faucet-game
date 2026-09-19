<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use RuntimeException;

class FaucetPayService
{
    private const BASE_URL = 'https://faucetpay.io/api/v2';

    private function getApiKey(): string
    {
        $key = (string) Setting::where('key', 'faucetpay_api')->value('value');

        if ($key === '') {
            throw new RuntimeException('FaucetPay API key is not configured.');
        }

        return $key;
    }

    /**
     * Verify that an address belongs to a FaucetPay user.
     */
    public function verify(string $email): array
    {
        $response = Http::withToken($this->getApiKey())
            ->acceptJson()
            ->asJson()
            ->timeout(15)
            ->post(self::BASE_URL.'/check-address', [
                'address' => $email,
            ]);

        return $this->handleVerifyResponse($response);
    }

    /**
     * Send cryptocurrency to a FaucetPay user.
     */
    public function send(float|int $amount, string $currency, string $to): array
    {
        $satoshi = (int) round($amount * 100_000_000);

        $payload = [
            'idempotency_key' => Str::random(15),
            'amount' => $satoshi,
            'to' => $to,
            'currency' => strtoupper($currency),
        ];

        $response = Http::withToken($this->getApiKey())
            ->acceptJson()
            ->asJson()
            ->timeout(15)
            ->post(self::BASE_URL.'/send', $payload);

        return $this->handleVerifyResponse($response);
    }

    /**
     * Handle FaucetPay verify response without throwing exception.
     */
    private function handleVerifyResponse(Response $response): array
    {
        if (! $response->json()) {
            return [
                'status' => 500,
                'message' => 'Invalid response from FaucetPay.',
            ];
        }

        $data = $response->json();

        // Return the data as-is, including error messages from FaucetPay
        return $data;
    }
}
