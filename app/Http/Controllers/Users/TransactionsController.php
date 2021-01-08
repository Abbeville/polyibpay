<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\CryptoRequest;
use App\Models\Transaction;
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
        $btc_rate = DB::table('settings')->where('name', '=', 'btc_rate')->first();
        return view('users.transactions.crypto-request', compact('btc_rate'));

    }

    public function crypto_request_save()
    {

            $data = request()->validate([
                'amount_crypto' => 'required|max:11',
                'amount_usd' => 'required'
            ]);

            $request_id = mt_rand(111111, 999999);
            $check = DB::table('crypto_requests')->where('request_id', $request_id)->count();
            if($check > 0){
                $request_id = mt_rand(111111, 999999);
            }

            $rate = DB::table('settings')->where('name', '=', 'btc_rate')->first();
            $amount_naira = (float)$rate->value * (float)$data['amount_usd'];

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'type' => 'credit',
                'custom_ref' => generateCustomRef(auth()->user()->id),
                'occurred_on' => 'wallet',
                'category' => 'crypto',
                'amount' => $amount_naira,
                'reference' => 'BTC_'.$request_id,
                'narration' => 'Bitcoin',
                'status' => 'pending',
                'created_at' => Carbon::now()
            ]);

            $request = CryptoRequest::create([
                'user_id' => Auth::id(),
                'transaction_id' => $transaction->id,
                'amount_crypto' => (float)$data['amount_crypto'],
                'amount_usd' => (float)$data['amount_usd'],
                'amount_ngn' => (float)$amount_naira,
                'current_rate' => $rate->value,
                'type' => 'btc',
                'request_id' => $request_id,
                'created_at' => Carbon::now()
            ]);

            return redirect(route('users.transactions.crypto-transfer', ['request' => $request_id]));


    }

    public function cryptoTransfer(){
        $request = request('request');
        $check = CryptoRequest::where('request_id', $request);
        if($check->count() < 1){
            session()->flash('warning', 'Invalid Crypto Transfer Url');
            return redirect('/dashboard/transactions/crypto');
        }

        if($check->first()->user_id != Auth::id()){
                session()->flash('warning', 'Invalid Crypto Transfer Url');
                return redirect('/dashboard/transactions/crypto');
        }
        $crypto_request = CryptoRequest::where('request_id', $request)->first();
//        dd($crypto_request);
        $wallet = DB::table('settings')->where('key', '=', 'btc_wallet_address')->first()->value;
        return view('users.transactions.crypto-transfer', compact('request', 'crypto_request', 'wallet'));
    }

    public function saveTransfer()
    {
        $data = request()->validate([
           'hash' => 'required',
           'proof' => 'required|mimes:jpg,png,jpeg,bmp'
        ]);

        $proof = request('proof')->store('uploads/crypto_proof', 'public');


        DB::table('crypto_requests')->where('request_id', \request('request'))
            ->update([
               'proof_file' => $proof,
               'hash_code' => $data['hash'],
                'status' => 'transferred',
                'updated_at' => Carbon::now()
            ]);

        session()->flash('success', 'Submitted. Your wallet will be credited once confirmed');
        return redirect('/dashboard');
    }

    public function cryptoTransactions()
    {
        $transactions = DB::table('crypto_requests')->where('user_id', Auth::id())->latest()->paginate(15);
        return view('users.transactions.crypto-transactions', compact('transactions'));
    }
}
