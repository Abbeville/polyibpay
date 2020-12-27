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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $request->input('type');
        $users = $this->pick_user_type($list);
        return view('admin.user.index', [
            'users' => $users,
            'all_users' => User::all(),
            'new_users' => User::LastMonthNewUsers(),
            'active_users' => User::status('active'),
            'inactive_users' => User::status('inactive'),
            'suspended_users' => User::status('suspended'),
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
        $response = $client->request('GET', 'https://api.flutterwave.com/v3/virtual-cards/'. '7dc7b98c-7f6d-48f3-9b31-859a145c8085', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer FLWSECK_TEST-SANDBOXDEMOKEY-X'
            ]]);

        $result1 = json_decode($response->getBody()->getContents(), true);

        if ($result1['status'] == 'success') {
            $online_card_info = $result1['data'];
        }
        
        // make api request to fetch all transactions on card  (params = ?from=2019-01-01&to=2020-01-13&index=1&size=5")
        $client = new Client();
        $response = $client->request('GET', 'https://api.flutterwave.com/v3/virtual-cards/'. '38c9201a-fcb2-48fd-875e-6494ed79a6bb'.'/transactions?from=2019-01-01&to=2020-01-13&index=1&size=5', [
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
                'Authorization' => 'Bearer FLWSECK_TEST-SANDBOXDEMOKEY-X'
            ]]);

        $result2 = json_decode($response->getBody()->getContents(), true);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * selecting a category of user from request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pick_user_type($type)
    {
        switch ($type) {
            case 'active':
                $users = User::status('active');
                $cat = 'Active';
                break;

            case 'inactive':
                $users = User::status('inactive');
                $cat = 'Inactive';
                break;

            case 'suspended':
                $users = User::status('suspended');
                $cat = 'Suspended';
                break;

            default:
                $users = User::latest()->get();
                $cat = 'All';
                break;
        }
        return ['users' => $users, 'cat' => $cat];
    }
}
