<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
// use GuzzleHttp\Psr7\Request;

use Alert;

// Models
use App\User;
use App\Models\VirtualCard;

class VirtualCardController extends Controller
{

    // Crits for flutter api requests
    protected $client;
    protected $apiKey;
    protected $headers;

    public function __construct()
    {

        // $this->apiKey = config('rave.secretKey');
        $this->apiKey = 'FLWSECK_TEST-SANDBOXDEMOKEY-X';

        $this->headers = [ 'Authorization' => 'Bearer ' . $this->apiKey, 
                            'Accept' => 'application/json', 
                            'Content-Type' => 'application/json' 
                        ];

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $request->input('type');
        $vcards = $this->pick_card_type($list);
        return view('admin.vcard.index', [
            'vcards' => $vcards,
            'all_vcards' => VirtualCard::all(),
            'active_cards' => VirtualCard::active(1),
            'inactive_cards' => VirtualCard::active(0),
            'terminated_cards' => VirtualCard::active(2),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($vcard)
    {
        // get the card in database to access other card infos (esp card_id)
        $vcard = VirtualCard::where('id', $vcard)->with(['user', 'transactions'])->first();

        // make api request to fetch card so as to get normal card
        $client = new Client();
        $url = 'https://api.flutterwave.com/v3/virtual-cards/'. $vcard->card_id;
        $response = $client->request('GET', $url, [ 'headers' => $this->headers]);
        $result1 = json_decode($response->getBody()->getContents(), true);

        if ($result1['status'] == 'success') {
            $online_card_info = $result1['data'];
        }
        
        // make api request to fetch all transactions on card  (params = ?from=2019-01-01&to=2020-01-13&index=1&size=5")

        $url2 = 'https://api.flutterwave.com/v3/virtual-cards/'. $vcard->card_id .'/transactions?from=2019-01-01&to=2020-01-13&index=1&size=5';
        $response2 = $client->request('GET', $url2 , ['headers' => $this->headers]);

        $result2 = json_decode($response2->getBody()->getContents(), true);
        if ($result2['status'] == 'success') {
            if ($result2['data'] == null) {
                $online_card_transactions = [];
            }else{
                $online_card_transactions = $result2['data'];
            }
        }

        return view('admin.vcard.profile', ['vcard' => $vcard, 'online_card_info' => $online_card_info, 'online_card_transactions' => $online_card_transactions]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(VirtualCard $vcard, $status)
    {

        $client = new Client();
        $url = "https://api.flutterwave.com/v3/virtual-cards/" . $vcard->card_id . "/status/". $status;

        try {
            $response = $client->request('PUT', $url, [ 'headers' => $this->headers]);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($result['status'] == 'success') {
            toast('Virtual Card Status Changed Successfully','success');
            return redirect()->back();
        }
        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deposit(Request $request, VirtualCard $vcard)
    {
        $client = new Client([ 'headers' => $this->headers] );
        $url = "https://api.flutterwave.com/v3/virtual-cards/" . $vcard->card_id . "/fund";

        try {
            $response = $client->post($url, ['json' => $request->all()]);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($result['status'] == 'success') {
            toast('Card funded successfully','success');
            return redirect()->back();
        }
        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function withdraw(Request $request, VirtualCard $vcard)
    {
        $client = new Client();
        $url = "https://api.flutterwave.com/v3/virtual-cards/" . $vcard->card_id . "/status/". $status;

        try {
            $response = $client->request('PUT', $url, [ 'headers' => $this->headers]);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($result['status'] == 'success') {
            toast('Virtual Card Status Changed Successfully','success');
            return redirect()->back();
        }
        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(VirtualCard $vcard, $back = null)
    {
        $user = $vcard->user_id;
        $client = new Client();
        $url = "https://api.flutterwave.com/v3/virtual-cards/" . $vcard->card_id . "/terminate";

        try {
            $response = $client->request('PUT', $url, [ 'headers' => $this->headers]);
            $result = json_decode($response->getBody()->getContents(), true);
        } catch (Exception $e) {
            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($result['status'] == 'success') {
            $vcard->delete();
            toast('Transaction Deleted Successfully','success');
            if (is_null($back)) {
                return redirect()->route('admin.vcard.index');
            }
            return redirect()->route('admin.user.virtual_card.show', $user);
        }
    }



    /**
     * selecting a category of user from request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pick_card_type($type)
    {
        switch ($type) {
            case '1':
                $vcards = VirtualCard::active(1);
                $cat = 'Active';
                break;

            case '0':
                $vcards = VirtualCard::active(0);
                $cat = 'Inactive';
                break;

            case '2':
                $vcards = VirtualCard::active(2);
                $cat = 'Terminated';
                break;

            default:
                $vcards = VirtualCard::latest()->get();
                $cat = 'All';
                break;
        }
        return ['vcards' => $vcards, 'cat' => $cat];
    }
}
