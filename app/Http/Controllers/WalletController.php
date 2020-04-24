<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wallet;
use App\Services\Wallet\WalletService;
use App\Services\CoinMarketCap\CoinMarketCapService;
use App\Services\Currency\CurrencyService;
use App\Http\Requests\StoreWalletPost;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(
                        Wallet $wallet, 
                        WalletService $walletService, 
                        CoinMarketCapService $coinMarketCapService,
                        CurrencyService $currency
                    )
    {
        $currency->setFrom('BTC');
        $currency->setTo('BRL');
        $currencyBrl = $currency->getCurrencyByFromTo();
        $brl = $currencyBrl->price;

        $currency->setFrom('BTC');
        $currency->setTo('USD');
        $currencyUsd = $currency->getCurrencyByFromTo();
        $usd = $currencyUsd->price;
        
        $items = $wallet->paginate(10)->items();
        $links = $wallet->paginate(10)->links();

        $totalFinalBalance = 0.00000000;
        $its = [];
        
        foreach ($items as $item) {
            $totalFinalBalance = $totalFinalBalance + $item->final_balance;
            $its[] = (object) [
                "id"           => $item->id,
                "name"         => $item->name,
                "public_key"   => $item->public_key,
                "finalBalance" => $item->final_balance,
                "status"       => 'success',
                "msg"          => 'success',
            ];
        }
        return view('wallets.index',
            [
                'wallets' => (object) $its,
                'pagination' => $links,
                'brl' => number_format($brl,2,",","."),
                'usd' =>   number_format($usd,2,",","."),
                'total' => number_format($totalFinalBalance,2,",","."),
                'totalBrl' => number_format($brl * $totalFinalBalance,2,",","."),
                'totalUsd' => number_format($usd * $totalFinalBalance,2,",","."),
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('wallets.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WalletService $walletService, StoreWalletPost $request)
    {
        $walletService->setPublicKey($request->get('public_key'));
        $walletService->setName($request->get('name'));
        $walletService->save();

        if ($walletService->wasSaved()) {
            return redirect()->route('wallets.index')->withSuccess(['Wallet successfully Saved: '.$walletService->getPublicKey()]);
        } else {
            return redirect()->route('wallets.index')->withError(['Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function show(Wallet $wallet)
    {
        dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function edit(Wallet $wallet)
    {
        dd('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        dd('update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet  $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, WalletService $wallet)
    {
        $wallet->setId($request->wallet);
        $wallet->delete();
        return redirect()->route('wallets.index')->withSuccess(['Wallet successfully Deleted']);
    }
}
