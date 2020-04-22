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

        $balanceWallets = 0.00000000;
        $its = [];
        foreach ($items as $item) {
            $wallet = $walletService->getWallet($item->public_key);
            if($wallet->status == 'success') {
                $balanceWallets = $balanceWallets + $wallet->finalBalance;
            } 

            $its[] = (object) [
                "id"           => $item->id,
                "name"         => $item->name,
                "public_key"   => $item->public_key,
                "finalBalance" => $wallet->finalBalance,
                "status"       => $wallet->status,
                "msg"          => $wallet->msg,
            ];
        }

        return view('wallets.index',
            [
                'wallets' => (object) $its,
                'pagination' => $links,
                'brl' => $brl,
                'usd' => $usd,
                'total' => $balanceWallets,
                'totalBrl' => $brl * $balanceWallets,
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
    public function destroy(Request $request, Service $wallet)
    {
        $wallet->setId($request->wallet);
        $wallet->delete();
        return redirect()->route('wallets.index')->withSuccess(['Wallet successfully Deleted']);
    }
}
