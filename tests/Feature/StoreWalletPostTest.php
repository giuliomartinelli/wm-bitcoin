<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Wallet;

class StoreWalletPostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreWalletPost()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "test nome"
        ]);

        $this->assertCount(1, Wallet::all());
    }

    public function testStoreWalletPostPublicKeyRequired()
    {
        $response = $this->post('/wallets',[
            "public_key" => "",
            "name" => "test nome"
        ]);

        $response->assertSessionHasErrors('public_key');
    }

    public function testStoreWalletPostPublicKeyUnique()
    {
        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "test nome"
        ]);

        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "test nome"
        ]);

        $response->assertSessionHasErrors('public_key');
    }

    public function testStoreWalletPostPublicKeyMin34()
    {
        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9",
            "name" => "test nome"
        ]);

        $response->assertSessionHasErrors('public_key');
    }

    public function testStoreWalletPostPublicKeyMax34()
    {
        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXaaaa",
            "name" => "test nome"
        ]);

        $response->assertSessionHasErrors('public_key');
    }

    public function testStoreWalletPostPublicKeyIsValidAddress()
    {
        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgddddd",
            "name" => "test nome"
        ]);

        $response->assertSessionHasErrors('public_key');
    }



    public function testStoreWalletPostNameRequired()
    {

        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => ""
        ]);

        $response->assertSessionHasErrors('name');
    }


    public function testStoreWalletPostNameMax32()
    {
        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "123456789012345678901234567890123"
        ]);

        $response->assertSessionHasErrors('name');
    }

}
