<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Guzzle\Http\Exception\ClientErrorResponseException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Exception\BadResponseException;

class TestController extends Controller
{
    public function test()
    {
    	$client = new \GuzzleHttp\Client();

		$apiKey = env('RAVE_SECRET_KEY');
    	$url = 'https://api.flutterwave.com/v3/bill-categories';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', ];

    	$response = $client->request('GET', $url, [
    		'headers' => $headers
    	]);

    	dd($response->getBody());
    }
}
