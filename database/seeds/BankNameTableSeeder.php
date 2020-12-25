<?php

use Illuminate\Database\Seeder;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

use App\Models\BankName;

class BankNameTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $client = new GuzzleHttp\Client();
	    $response = $client->request('GET', 'https://api.paystack.co/bank', [
	        'headers' => [
	            'Accept' => 'application/json',
	            'Content-type' => 'application/json'
	        ]]);
	    $result = json_decode($response->getBody()->getContents(), true);


	    if ($result['status']) {
	        $bankCount = count($result['data']);
	        for ($i = 0; $i < $bankCount; $i++) {
	            if ($result['data'][$i]['type'] === 'nuban' && $result['data'][$i]['is_deleted'] === null) {
	            	$bank = new BankName();
	            	$bank->bank_name = $result['data'][$i]['name'];
	            	$bank->code = $result['data'][$i]['code'];
	            	$bank->slug = $result['data'][$i]['slug'];
	            	$bank->status = $result['data'][$i]['active'];
	            	$bank->save();
	            }
	       	}
	    }
    }
}
