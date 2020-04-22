<?php

namespace App\Services\Wallet;

use App\Wallet as WalletModel;
use Blockchain\Blockchain;

class WalletService
{
    private $wallet;
    private $blockchain;
    private $id;
    private $publicKey;
    private $name;

    
    private $wasSaved;
    
    public function __construct(WalletModel $wallet,Blockchain $blockchain)
    {
        $this->wallet     = $wallet;
        $this->blockchain = $blockchain;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }
    
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
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
        $this->wallet->name        = $this->name;
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

    public function delete()
    {
        $wallet = $this->wallet->find($this->id);
        $wallet->delete();
        return;
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

    
    public function getWallet($publicKey = '')
    {
        $finalBalance = 0.00000000;
        $status       = '';
        $msg          = '';

        try {
            $address = $this->blockchain->Explorer->getHash160Address($publicKey);
            $finalBalance = $address->final_balance;
            $status       = 'success';
            $msg          = 'success';
            
            return  $object[] = (object) [
                "status"       => $status,
                "finalBalance" => $finalBalance,
                "msg"          => $msg,
                "publicKey"    => $publicKey
            ];
            
        } catch (\Exception $e) {
            $status       = 'error';
            $msg          = 'INVALID ADDRESS';
        
            return  $object[] = (object) [
                "status"       => $status,
                "finalBalance" => $finalBalance,
                "msg"          => $msg,
                "publicKey"    => $publicKey
            ];
        }
    }


    // public function getTotalWallet($publicKey)
    // {
    //     try {
    //         $address = $this->blockchain->Explorer->getHash160Address($publicKey);
    //         return $address->final_balance;
    //     } catch (\Exception $e) {
    //         return 'INVALID ADDRESS';
    //     }
    // }

}
