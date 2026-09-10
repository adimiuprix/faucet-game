<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\Setting;
use RuntimeException;

class CoinMarketCapService
{
    private const BASE_URL = 'https://pro-api.coinmarketcap.com';
    private const ENDPOINT = '/v2/cryptocurrency/quotes/latest';

    public function price(string $symbol): float
    {
        $response = Http::timeout(10)
            ->acceptJson()
            ->withHeaders([
                'X-CMC_PRO_API_KEY' => (string) Setting::where('key', 'coinmarketcap_api')->value('value'),
            ])
            ->get(self::BASE_URL . self::ENDPOINT, [
                'symbol' => strtoupper($symbol),
                'convert' => 'USD',
            ]);

        $response->throw();

        $result = $response->json();

        if (($result['status']['error_code'] ?? 0) !== 0) {
            throw new RuntimeException(
                $result['status']['error_message']
                    ?? 'CoinMarketCap API error.'
            );
        }

        $data = $result['data'] ?? [];

        if (empty($data)) {
            throw new RuntimeException(
                "Coin {$symbol} not found."
            );
        }

        $coin = array_values($data)[0][0];
        
        $price = $coin['quote']['USD']['price'] ?? null;

        if (!is_numeric($price) || $price <= 0) {
            throw new RuntimeException(
                "Price is invalid."
            );
        }

        return (float) $price;
    }

    public function usdToCoin(string $symbol, float $usdAmount): float
    {
        if ($usdAmount <= 0) {
            throw new RuntimeException(
                'USD must be greater than 0.'
            );
        }

        $price = $this->price($symbol);

        return $usdAmount / $price;
    }
}