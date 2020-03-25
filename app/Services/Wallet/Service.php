<?php

namespace App\Services\Wallet;

use App\Wallet as WalletModel;
use Blockchain\Blockchain;

class Service
{
    private $wallet;
    private $blockchain;
    private $publicKey;
    
    private $wasSaved;
    
    public function __construct(WalletModel $wallet,Blockchain $blockchain)
    {
        $this->wallet     = $wallet;
        $this->blockchain = $blockchain;
    }

    
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function save()
    {
        $validated = $this->validateFields();
        
        if (! $validated) {
            // return errors
            $this->wasSaved = false;
            return ;
        }
        
        $this->wallet->public_key  = $this->publicKey;
        $save = $this->wallet->save();

        if($save) {
            $this->wasSaved = true;
        } else {
            // return errors
            $this->wasSaved = false;
        }
    }

    public function wasSaved()
    {
        return $this->wasSaved;
    }

    public function validateFields()
    {
        $validate = true;
        if(! $this->publicKey) {
            // errors;
            $validate = false;
        }

        return $validate;

    }

    
    public function getWallet($publicKey)
    {
        try {
            $address = $this->blockchain->Explorer->getHash160Address($publicKey);
            return $address->final_balance;
        } catch (\Exception $e) {
            return 'INVALID ADDRESS';
        }
    }


    public function getTotalWallet($publicKey)
    {
        try {
            $address = $this->blockchain->Explorer->getHash160Address($publicKey);
            return $address->final_balance;
        } catch (\Exception $e) {
            return 'INVALID ADDRESS';
        }
    }

}
