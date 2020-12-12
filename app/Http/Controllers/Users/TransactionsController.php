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
        $transactions = DB::table('transactions')->where('user_id', auth()->user()->id);
        $bitcoin  = DB::table('transactions')->
        where('user_id', auth()->user()->id)
        ->where('type', 'btc');
        //return view('');
    }

    public function crypto()
    {
        return view('users.transactions.crypto-request');
    }

    public function crypto_request_save()
    {
        $data = request()->validate([
            'amount' => 'required'
        ]);

        DB::table('crypto_request')->insert([
           'user_id' => Auth::id(),
           'amount' => $data['amount'],
           'type' => 'btc',
            'hash_code' => '',
            'created_at' => Carbon::now()
        ]);

        return redirect(route('users.transactions.crypto-transfer'));


    }

    public function cryptoTransfer(){
        return view('users.transactions.crypto-transfer');
    }
}
