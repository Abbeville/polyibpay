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

		$this->apiKey = config('rave.secretKey');

    	$this->headers = [ 'Authorization' => 'Bearer ' . $this->apiKey, 'Accept' => 'application/json', 'Content-Type' => 'application/json' ];

	}

    public function index($category, $biller_code){

        $url = 'https://api.flutterwave.com/v3/bill-categories?biller_code='.$biller_code;

        $response = $this->client->request('GET', $url, [
            'headers' => $this->headers
        ]);

        $response = json_decode($response->getBody()->getContents());

        $packages = $response->data;

        // $packages = BillerService::where('biller_code', $biller_code)->get();

        return view('users.dashboard.purchase', compact('category', 'biller_code', 'packages'));
    }

    public function createBill(Request $request)
    {
    	$this->validateBill($request->item_code, $request->biller_code, $request->customer);

        /*Check if user has enough balance in wallet*/
        if ($request->amount > auth()->user()->wallet->balance) {

            $balance = $request->amount - auth()->user()->wallet->balance;

            session()->flash('amount_to_recharge', $balance);
            return redirect()->route('users.dashboard');

        }

        $item_code = $request->item_code;

    	$data['country'] = 'NG';
    	$data['customer'] = $request->customer;
    	$data['amount'] = $request->amount;
        $data['amount'] = '500';
    	$data['recurrence'] = 'ONCE';
    	$data['type'] = $request->biller_name;
    	$data['reference'] = generateTransactionRef();

    	$client = new \GuzzleHttp\Client([
    	    'headers' => [ 
    	    	'Authorization' => 'Bearer ' . $this->apiKey, 
    	    	'Accept' => 'application/json', 
    	    	'Content-Type' => 'application/json' 
    		]
    	]);
    	
    	$url = 'https://api.flutterwave.com/v3/bills';

    	$request = $client->post($url, ['json' => $data]);
    	$response = $request->getBody()->getContents();
    	$response = json_decode($response);

    	if ($response->status == 'success') {
    		//Save the transaction
    		$transaction = Transaction::create([
    			'user_id' => auth()->user()->id,
    			'type' => 'debit',
    			'category' => 'bill',
    			'reference' => generateTransactionRef(),
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
                'item_code' => $item_code
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

    		session()->flash('error', $response->message);

    		return redirect()->back();
    	}
    }
}
