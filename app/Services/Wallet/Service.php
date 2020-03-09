<?php

namespace App\Services\Wallet;

use App\Wallet as WalletModel;

class Service
{
    private $wallet;
    private $publicKey;
    private $privateKey;
    
    private $wasSaved;
    
    public function __construct(WalletModel $wallet)
    {
        $this->wallet = $wallet;
    }

    
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }



    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    public function setPrivateKey($privateKey)
    {
        $this->privateKey = $privateKey;
    }


    public function save()
    {
        $validated = $this->validateFields();
        if (! $validated) {
            return ;
        }

        $this->wallet->public_key  = $this->publicKey;
        $this->wallet->private_key = $this->privateKey;
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

        if(! $this->privateKey) {
            // errors;
            $validate = false;
        }

    }
}
