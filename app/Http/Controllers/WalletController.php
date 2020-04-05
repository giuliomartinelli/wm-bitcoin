<?php

namespace App\Http\Controllers;

use App\Wallet;
//use Blockchain\Blockchain;
use Illuminate\Http\Request;

use App\Services\Wallet\Service;
use App\Services\CoinMarketCap\Service as CoinMarketCapService;
use App\Http\Requests\StoreWalletPost;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Wallet $wallet, Service $walletService, CoinMarketCapService $coinMarketCapService)
    {

        $coin1 = $coinMarketCapService->factory();
        $coin1->setSymbol("BTC");
        $coin1->setConvert("BRL");
        $brl = $coin1->cryptocurrencyQuotesLatest();

        // $coin2 = $coinMarketCapService->factory();
        // $coin2->setSymbol("BTC");
        // $coin2->setConvert("USD");
        // $usd = $coin2->cryptocurrencyQuotesLatest();
        //,$usd["data"]["BTC"]["quote"]["USD"]["price"]
        $brl = $brl["data"]["BTC"]["quote"]["BRL"]["price"];
        
        //$wallet->getWallet("1AtobE3XqCPS3Qk8vA8nY6xBzhR8TkTXSX");

        $items = $wallet->paginate(10)->items();
        $links = $wallet->paginate(10)->links();

        $total = 0;
        $its = [];

        foreach ($items as $item) {
            if (is_numeric($walletService->getTotalWallet($item->public_key))) {
                $total = $total + $walletService->getTotalWallet($item->public_key);
            }
            $its[] = (object) [
                "id" => $item->id,
                "name" => $item->name,
                "public_key" => $item->public_key,
                "total" => $walletService->getTotalWallet($item->public_key)
            ];
        }

        return view('wallets.index',
            [
                'wallets' => (object) $its,
                'pagination' => $links,
                'brl' => $brl,
                'total' => $total,
                'totalBrl' => $brl * $total,
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
    public function store(Service $wallet, StoreWalletPost $request)
    {
        $wallet->setPublicKey($request->get('public_key'));
        $wallet->setName($request->get('name'));
        $wallet->save();

        if ($wallet->wasSaved()) {
            return redirect()->route('wallets.index')->withSuccess(['Wallet successfully Saved: '.$wallet->getPublicKey()]);
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
