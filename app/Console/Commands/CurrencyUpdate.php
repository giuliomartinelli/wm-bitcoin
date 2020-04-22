<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\CoinMarketCap\CoinMarketCapService;
use App\Services\Currency\CurrencyService;

class CurrencyUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currency:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all values of currencies';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $btcToBrl = new CoinMarketCapService();
        $btcToUsd = new CoinMarketCapService();

        $btcToBrl->setSymbol("BTC");
        $btcToBrl->setConvert("BRL");
        $btcToBrl = $btcToBrl->cryptocurrencyQuotesLatest();

        $btcToUsd->setSymbol("BTC");
        $btcToUsd->setConvert("USD");
        $btcToUsd = $btcToUsd->cryptocurrencyQuotesLatest();
        
        $usdPrice = $btcToUsd["data"]["BTC"]["quote"]["USD"]["price"];
        $brlPrice = $btcToBrl["data"]["BTC"]["quote"]["BRL"]["price"];

        $currency = new CurrencyService();

        $currency->setFrom('BTC');
        $currency->setTo('BRL');
        $currencyBrl =  $currency->getCurrencyByFromTo();
        $currencyBrl->price = $brlPrice;
        $currencyBrl->save();

        $currency->setFrom('BTC');
        $currency->setTo('USD');
        $currencyUsd =  $currency->getCurrencyByFromTo();
        $currencyUsd->price = $usdPrice;
        $currencyUsd->save();

    }
}
