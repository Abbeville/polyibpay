<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
//        $data = request()->validate([
//            'amount'
//        ]);
    }
}
