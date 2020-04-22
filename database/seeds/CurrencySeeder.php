<?php

use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
