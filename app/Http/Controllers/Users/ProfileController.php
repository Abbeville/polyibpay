<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $profile = DB::table('user_data')->where('user_id', auth()->user()->id)->first();

        if($profile){
            return view('users.profile.index', compact('profile'));
        }else{
            return redirect('/dashboard/profile/edit');
        }
    }


    public function edit(){
        if(auth()->user()->pin != ''){
            $profile = DB::table('user_data')->where('user_id', auth()->user()->id)->first();
            $banks = DB::table('bank_names')->get();

            return view('users.profile.edit', compact('profile', 'banks'));
        }else{
            session()->flash('error', 'Kindly set a transaction pin to update your profile details');
            return redirect('/dashboard/settings/pin');
        }

    }

    public function update()
    {
        $data = request()->validate([
            'account_name' => 'required|min:3',
            'account_number' => 'required|min:10|max:10',
            'bank' => '',
            'account_type' => '',
            'btc_address' => '',
            'eth_address' => '',
            'pin' => '',
            'address' => 'required',
            'city' => 'required',
            'zip_code' => '',
            'state' => 'required',
            'dob' => 'required'
        ]);

        $pin_check = Hash::check($data['pin'], auth()->user()->pin);
        if(!$pin_check){
            session()->flash('error', 'Incorrect Transaction Pin');
            return redirect()->back();
        }

        $check = DB::table('user_data')->where('user_id', '=', auth()->user()->id)->count();

        if($check < 1){
            DB::table('user_data')->insert([
                'user_id' =>  auth()->user()->id,
                'bank_account_name' => $data['account_name'],
                'bank_account_number' => $data['account_number'],
                'bank_name_id' => $data['bank'],
                'bank_account_type' => $data['account_type'],
                'btc_address' => $data['btc_address'],
                'eth_address' => $data['eth_address'],
                'address' => $data['address'],
                'city' => $data['city'],
                'state' => $data['state'],
                'dob' => $data['dob'],
                'zip_code' => $data['zip_code']
            ]);

            session()->flash('success', 'Profile Updated Successfully');
            return redirect('/dashboard');
        }else{
            DB::table('user_data')->where('user_id', auth()->user()->id)
                ->update([
                    'user_id' =>  auth()->user()->id,
                    'bank_account_name' => $data['account_name'],
                    'bank_account_number' => $data['account_number'],
                    'bank_name_id' => $data['bank'],
                    'bank_account_type' => $data['account_type'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'dob' => $data['dob'],
                    'zip_code' => $data['zip_code']

                ]);

            if (request('btc_address') != ''){
                DB::table('user_data')->where('user_id', auth()->user()->id)
                    ->update([
                'btc_address' => $data['btc_address']
                    ]);
            }

            if (request('eth_address')){
                DB::table('user_data')->where('user_id', auth()->user()->id)
                    ->update([
                        'eth_address' => $data['eth_address']
                    ]);
            }
            session()->flash('success', 'Profile Updated Successfully');
            return redirect('/dashboard');
        }
    }





}
