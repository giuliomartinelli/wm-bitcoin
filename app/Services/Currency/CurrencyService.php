<?php

namespace App\Services\Currency;
use Illuminate\Support\Facades\Http;
use App\Currency as CurrencyModel;


class CurrencyService
{
    private $from;
    private $to;
    private $price;
    private $currency;

    public function __construct()
    {
        $this->currency = new CurrencyModel();
    }

    public function setFrom($from) 
    {
        $this->from = $from;
    }
    public function getFrom() 
    {
        return $this->from;
    }

    public function setTo($to) 
    {
        $this->to = $to;
    }
    public function getTo() 
    {
        return $this->to;
    }

    public function setPrice($price) 
    {
        $this->price = $price;
    }
    public function getPrice() 
    {
        return $this->price;
    }

    public function getCurrencyByFromTo()
    {
        $currency = $this->currency->where('from', $this->from)->where('to', $this->to)->first();

        if ( $currency ) {
            return $currency;
        } else {
            return null;
        }
    }

    public function getCurrencyById($id)
    {
        $currency = $this->currency->find($id);
        if ( $currency ) {
            return $currency;
        } else {
            return null;
        }
    }
}
