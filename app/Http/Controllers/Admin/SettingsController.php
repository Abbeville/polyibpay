<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;

use App\Setting;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function crypto_index()
    {
        return view('admin.settings.crypto_index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_btc_status($status, $crypto)
    {
        if ($crypto == 'btc') {
            $status = Setting::where('key', 'btc_status')->update(['value' => $status]);
        }elseif ($crypto == 'eth') {
            $status = Setting::where('key', 'eth_status')->update(['value' => $status]);
        }

        if ($status) {
            toast('Status Updated Successfully','success');
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
    public function update_btc_info(Request $request, $crypto)
    {
        if ($crypto == 'btc') {
            $update = Setting::where('key', 'btc_wallet_address')->update([
                'name' => $request->input('btc_wallet_address_name'),
                'value' => $request->input('btc_wallet_address_value'),
                'description' => $request->input('btc_wallet_address_decription'),
            ]);

            $update = Setting::where('key', 'btc_rate')->update([
                'name' => $request->input('btc_rate_name'),
                'value' => $request->input('btc_rate_value'),
                'description' => $request->input('btc_rate_description'),
            ]);
        }elseif($crypto == 'eth'){    
            $update = Setting::where('key', 'eth_wallet_address')->update([
                'name' => $request->input('eth_wallet_address_name'),
                'value' => $request->input('eth_wallet_address_value'),
                'description' => $request->input('eth_wallet_address_decription'),
            ]);

            $update = Setting::where('key', 'eth_rate')->update([
                'name' => $request->input('eth_rate_name'),
                'value' => $request->input('eth_rate_value'),
                'description' => $request->input('eth_rate_description'),
            ]);
        }

        if ($update) {
            toast('Settings Variables Updated Successfully','success');
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
    public function destroy($id)
    {
        //
    }
}
