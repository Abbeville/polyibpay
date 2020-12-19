<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionsController extends Controller
{
    public function index()
    {
        $transactions = DB::table('transactions')->where('user_id', auth()->user()->id)->get();
        $bitcoin  = DB::table('crypto_requests')->
        where('user_id', auth()->user()->id)->get();
        //return view('');
    }

    public function crypto()
    {
        return view('users.transactions.crypto-index');
    }

    public function cryptoRequest()
    {
        return view('users.transactions.crypto-request');

    }

    public function crypto_request_save()
    {
        $data = request()->validate([
            'amount' => 'required'
        ]);

        $request_id = mt_rand(111111, 999999);
        $check = DB::table('crypto_requests')->where('request_id', $request_id)->count();
        if($check > 0){
            $request_id = mt_rand(111111, 999999);
        }
        DB::table('crypto_requests')->insert([
           'user_id' => Auth::id(),
           'amount' => $data['amount'],
           'type' => 'btc',
            'hash_code' => '',
            'request_id' => $request_id,
            'created_at' => Carbon::now()
        ]);

        return redirect(route('users.transactions.crypto-transfer', ['request' => $request_id]));


    }

    public function cryptoTransfer(){
        $request = request('request');
        return view('users.transactions.crypto-transfer', compact('request'));
    }

    public function saveTransfer()
    {
        $data = \request()->validate([
           'hash' => 'required',
           'proof' => 'required|mimes:jpg,png,jpeg,bmp'
        ]);

        $proof = request('proof')->store('uploads/crypto_proof', 'public');


        DB::table('crypto_requests')->where('request_id', \request('request'))
            ->update([
               'proof_file' => $proof,
               'hash_code' => $data['hash'],
                'status' => 'active',
                'updated_at' => Carbon::now()
            ]);

        session()->flash('success', 'Submitted. Your wallet will be credited once confirmed');
        return redirect('/dashboard');
    }

    public function cryptoTransactions()
    {
        $transactions = DB::table('crypto_requests')->where('user_id', Auth::id())->get();
        return view('users.transactions.crypto-transactions', compact('transactions'));
    }
}
