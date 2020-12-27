<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;
use App\Models\ServiceCategory;
use App\Models\Biller;
use App\Models\BillerService;
use Illuminate\Support\Facades\DB;

class TestController extends Controller
{
    public function test()
    {

    	

    	/*$client = new \GuzzleHttp\Client();

		$apiKey = env('RAVE_SECRET_KEY');
    	$url = 'https://api.flutterwave.com/v3/bill-categories?power=1';
    	// $url = 'https://api.flutterwave.com/v3/bill-categories?biller_code=BIL108';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', ];

    	$response = $client->request('GET', $url, [
    		'headers' => $headers
    	]);

    	dd(json_decode($response->getBody()->getContents()));*/

    	/*$client = new \GuzzleHttp\Client();

		$apiKey = env('RAVE_SECRET_KEY');
    	// $url = 'https://api.flutterwave.com/v3/bill-categories?cables=1';
    	$url = 'https://api.flutterwave.com/v3/bill-categories?biller_code=';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', ];

        $billers = Biller::all();

        foreach ($billers as $biller) {

        	$response = $client->request('GET', $url.$biller->biller_code, [
        		'headers' => $headers
        	]);

        	$biller_services = collect(json_decode($response->getBody()->getContents())->data);


        	$biller_services->map(function ($value, $key) use ($biller) { 

    	        if ($biller->biller_code == $value->biller_code ) {

            		$service = new BillerService();

            		$service->create([
            			'biller_code' => $value->biller_code,
            			'name' => $value->name,
            			'is_airtime' => $value->is_airtime,
            			'biller_name' => $value->biller_name,
            			'fee' => $value->fee,
            			'label_name' => $value->label_name,
            			'amount' => $value->amount,
            			'item_code' => $value->item_code,
            			'short_name' => $value->short_name,
            			'biller_id' => $biller->id
            		]);
    	        }
    	    });

        }*/

    	/*$client = new \GuzzleHttp\Client();

		// $apiKey = env('RAVE_SECRET_KEY');
		$apiKey = 'FLWSECK_TEST-83bda8498a3d0c32683d53644ea37242-X';
    	$url = 'https://api.flutterwave.com/v3/bills';
    	// $url = 'https://api.flutterwave.com/v3/bill-categories?biller_code=BIL108';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded' ];

    	$response = $client->request('POST', $url, [
    		'headers' => $headers,
    		'form_params' => [
    			'country' => 'NG',
    			'customer' => '2348133957819',
    			'amount' => '500',
    			'recurrence' => 'ONCE',
    			'type' => 'AIRTIME',
    			'reference' => '99099903237',
    			'biller_name' => 'AIRTIME'
    		]
    	]);*/

    	// dd(json_decode($response->getBody()->getContents()));

    	/*$apiKey = 'FLWSECK_TEST-83bda8498a3d0c32683d53644ea37242-X';
    	$url = 'https://api.flutterwave.com/v3/bills';

    	$data = [
    		'country' => 'NG',
			'customer' => '08133957819',
			'amount' => '1',
			'recurrence' => 'ONCE',
			'type' => 'AIRTIME',
			'reference' => '979387237983',
    	];

    	$client = new \GuzzleHttp\Client([
    	    'headers' => [
    	        'Content-Type' => 'application/json',
    	        'Authorization' => 'Bearer ' . $apiKey, 
    	        'Accept' => 'application/json'
    	    ],
    	]);

    	$request = $client->post($url, ['json' => $data]);
    	$response = $request->getBody()->getContents();
    	$response = json_decode($response);

    	dd($response);*/


    	$client = new \GuzzleHttp\Client();

		// $apiKey = 'FLWSECK_TEST-83bda8498a3d0c32683d53644ea37242-X';
		$apiKey = 'FLWSECK-bdddf2152d2a201f4e80496f7493a825-X';
    	$url = 'https://api.flutterwave.com/v3/bill-items/AT099/validate?code=BIL108&customer=08133957819';
    	// $url = 'https://api.flutterwave.com/v3/bill-categories?biller_code=BIL108';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/json' ];

    	$response = $client->request('GET', $url, [
    		'headers' => $headers
    	]);
    	$response = json_decode($response->getBody()->getContents());
    	dd($response->data->response_code);
    }
}
