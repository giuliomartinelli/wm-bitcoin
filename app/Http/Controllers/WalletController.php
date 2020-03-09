<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;

use App\Services\Wallet\Service;
use App\Http\Requests\StoreWalletPost;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Wallet $wallet)
    {
        return view('wallets.index',['wallets' => $wallet->paginate(10)]);
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
        $wallet->setPrivateKey($request->get('private_key'));
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
    public function destroy(Wallet $wallet)
    {
        dd('destroy');
    }
}
