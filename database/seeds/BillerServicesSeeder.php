<?php

use Illuminate\Database\Seeder;
use App\Models\Biller;
use App\Models\BillerService;

class BillerServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	$client = new \GuzzleHttp\Client();

		// $apiKey = config('rave.secretKey');
        $apiKey = 'FLWSECK_TEST-3271edff45fdeff49120a73b08dbdc3f-X';
    	$url = 'https://api.flutterwave.com/v3/bill-categories?biller_code=';

    	$headers = [ 'Authorization' => 'Bearer ' . $apiKey, 'Accept' => 'application/json', ];

        $billers = Biller::all();

        foreach ($billers as $biller) {

        	$response = $client->request('GET', $url.$biller->biller_code, [
        		'headers' => $headers
        	]);

        	$biller_services = collect(json_decode($response->getBody()->getContents())->data);

            echo $biller_services.'\n';


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
        }
    }
}
