<?php

namespace App\Services\CoinMarketCap;
use Illuminate\Support\Facades\Http;

class CoinMarketCapService
{
    private $symbol;
    private $convert;

    private $urlApi;
    private $proApiKey;

    public function __construct()
    {
        $this->urlApi    = "https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest";
        $this->proApiKey = "e8977eb5-edfb-41a9-991b-e135ab83ae7f";
    }
    public function setSymbol($symbol)
    {
        $this->symbol = $symbol;
    }

    public function setConvert($convert)
    {
        $this->convert = $convert;
    }

    public function cryptocurrencyQuotesLatest()
    {
        $response = Http::withHeaders([
            'Accepts' => 'application/json',
            'X-CMC_PRO_API_KEY' => $this->proApiKey
        ])->get($this->urlApi, [
            'symbol' => $this->symbol,
            'convert' => $this->convert,
        ]);
        return $response->json();
    }

    public function factory()
    {
        return new $this;
    }
}
