<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'key' => 'btc_wallet_address', 
            	'name' => 'BTC Wallet Address', 
            	'value' => 'jshdfujshgdfbuyjhdsg7223qw8eu21',
            	'description' => 'This is general wallet address for user to send btc'
            ],
            [
                'key' => 'btc_rate', 
            	'name' => 'btc_rate', 
            	'value' => '400',
            	'description' => 'This is general rate of btc exchange rate'
            ],
            [
                'key' => 'eth_wallet_address', 
            	'name' => 'eth_wallet_address', 
            	'value' => 'sdhf223843j53849ujfg38',
            	'description' => 'This is general wallet address for user to send ethereum'
            ],
            [
                'key' => 'eth_rate', 
            	'name' => 'eth_rate', 
            	'value' => '470',
            	'description' => 'This is general rate of ethereum exchange rate'
            ],
            [
                'key' => 'btc_status', 
            	'name' => 'crypto_status', 
            	'value' => 'active',
            	'description' => 'This tells if crypto exchange service is available at a present moment or not'
            ],
            [
                'key' => 'eth_status', 
                'name' => 'crypto_status', 
                'value' => 'active',
                'description' => 'This tells if crypto exchange service is available at a present moment or not'
            ],
            
        ];
        DB::table('settings')->insert($data);
    }
}
