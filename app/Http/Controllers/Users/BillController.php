<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Transaction;
use App\Http\Controllers\Users\WalletController as Wallet;
use App\Models\BillerService;

class BillController extends Controller
{

	protected $client;
    protected $apiKey;
	protected $headers;

	public function __construct()
	{
    	$this->client = new \GuzzleHttp\Client();

		// $this->apiKey = config('rave.secretKey');
        $this->apiKey = 'FLWSECK_TEST-SANDBOXDEMOKEY-X';

    	$this->headers = [ 'Authorization' => 'Bearer ' . $this->apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/json' ];

	}

    public function index($category, $biller_code){

        $url = 'https://api.flutterwave.com/v3/bill-categories?biller_code='.$biller_code;

        $response = $this->client->request('GET', $url, [
            'headers' => $this->headers
        ]);

        $response = json_decode($response->getBody()->getContents());

        $packages = $response->data;

        return view('users.dashboard.purchase', compact('category', 'biller_code', 'packages'));
    }

    public function createBill(Request $request)
    {
        $data['category'] = $request->category;
        $data['item_code'] = $request->item_code;
        $data['country'] = $request->country;
        $data['customer'] = $request->customer;
        $data['amount'] = $request->amount;
        $data['recurrence'] = $request->recurrence;
        $data['type'] = $request->biller_name;
        $data['biller_code'] = $request->biller_code;
        $data['reference'] = generateTransactionRef($data['category']);

    	$this->validateBill($request->item_code, $request->biller_code, $request->customer);

        /*Check if user has enough balance in wallet*/
        if ($request->amount > auth()->user()->wallet->balance) {

            $balance = $request->amount - auth()->user()->wallet->balance;

            //save event session
            session()->put('process_data', $data);

            session()->flash('amount_to_recharge', $balance);
            return redirect()->route('users.dashboard');

        }

    	$client = new \GuzzleHttp\Client([
    	    'headers' => [ 
    	    	'Authorization' => 'Bearer ' . $this->apiKey, 
    	    	'Accept' => 'application/json', 
    	    	'Content-Type' => 'application/json' 
    		]
    	]);
    	
    	$url = 'https://api.flutterwave.com/v3/bills';
        try{
            $request = $client->post($url, ['json' => $data]);
            $response = $request->getBody()->getContents();
            $response = json_decode($response);
        }catch(\Exception $e){
            session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        
    	if ($response->status == 'success') {
    		//Save the transaction
    		$transaction = Transaction::create([
                'custom_ref' => generateCustomRef(auth()->user()->id),
    			'user_id' => auth()->user()->id,
    			'type' => 'debit',
    			'category' => 'bill',
    			'reference' => generateTransactionRef($data['category']),
    			'amount' => $response->data->amount,
    			'narration' => 'Purchased '.$data["type"].' for #'.$response->data->amount,
    			'status' => 'success'
    		]);

    		//Save the bill transaction
    		$transaction->bill()->create([
    			'customer_number' => $data['customer'],
    			'biller_name' => $data["type"],
    			'amount' => $data["amount"],
    			'type' => $data["type"],
                'item_code' => $data['item_code']
    		]);

    		//Carry out the operation on the wallet
    		Wallet::debit(auth()->id(), $data["amount"]);

            session()->flash('success', 'Transaction Successful');
            return redirect()->back();

    	}else{
            session()->flash('error', 'Transaction Failed');
    		return redirect()->back();
    	}
    }

    public function validateBill($item_code, $biller_code, $customer)
    {
    	$url = 'https://api.flutterwave.com/v3/bill-items/'.$item_code.'/validate?code='.$biller_code.'&customer='.$customer;

    	$response = $this->client->request('GET', $url, [
    		'headers' => $this->headers
    	]);

    	$response = json_decode($response->getBody()->getContents());
    	if ($response->status == 'success') {
    		return;
    	}else{
            dd('not validated');
    		session()->flash('error', $response->message);

    		return redirect()->back();
    	}
    }
}
