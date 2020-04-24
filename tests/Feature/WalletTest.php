<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use Illuminate\Support\Facades\DB;
use App\Wallet;

class WalletTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexWalletPost()
    {
        $this->withoutExceptionHandling();

        DB::table('currencies')->insert([
            'from'  => 'BTC',
            'to'    => 'BRL',
            'price' => 0,
        ]);

        DB::table('currencies')->insert([
            'from'  => 'BTC',
            'to'    => 'USD',
            'price' => 0,
        ]);
       
        // $this->artisan('currency:update');
        // $this->artisan('wallet:update');
        // $this->assertTrue(class_exists(\App\Console\Commands\CurrencyUpdate::class));
        // $this->assertTrue(class_exists(\App\Console\Commands\WalletsUpdate::class));

        $response = $this->get('/wallets');

        $response->assertOk();
    }

    public function testStoreWalletPost()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "test nome"
        ]);

        $this->assertCount(1, Wallet::all());

        $response->assertRedirect('/wallets');
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

    public function testDestroyWalletDelete()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/wallets',[
            "public_key" => "3FkenCiXpSLqD8L79intRNXUgjRoH9sjXa",
            "name" => "test nome"
        ]);

        $this->assertCount(1, Wallet::all());

        $wallet = Wallet::first();

        $response = $this->delete('/wallets/' . $wallet->id);

        $this->assertCount(0, Wallet::all());

        $response->assertRedirect('/wallets');
    }

}
