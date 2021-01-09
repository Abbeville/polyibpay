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
    public function index($category)
    {
        $user = auth()->user();
        if ($category == 'all') {
            $transactions = $user->transactions()
                                    ->where('status', 'success')
                                    ->latest()
                                    ->paginate(15);
        }else{
            $transactions = $user->transactions()->paginateByCategory($category);
        }

        return view('users.transactions.index', compact('transactions', 'category'));
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
                'amount' => 'required|max:11'
            ]);

            $request_id = mt_rand(111111, 999999);
            $check = DB::table('crypto_requests')->where('request_id', $request_id)->count();
            if($check > 0){
                $request_id = mt_rand(111111, 999999);
            }

            $transaction = Transaction::create([
                'user_id' => Auth::id(),
                'type' => 'credit',
                'custom_ref' => generateCustomRef(auth()->user()->id),
                'occurred_on' => 'wallet',
                'category' => 'crypto',
                'amount' => $data['amount'],
                'reference' => 'BTC_'.$request_id,
                'narration' => 'Bitcoin',
                'status' => 'pending',
                'created_at' => Carbon::now()
            ]);

            $reqeuest = CryptoRequest::create([
                'user_id' => Auth::id(),
                'transaction_id' => $transaction->id,
                'amount' => $data['amount'],
                'type' => 'btc',
                'hash_code' => ' ',
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
        return view('users.transactions.crypto-transfer', compact('request'));
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
        $transactions = DB::table('crypto_requests')->where('user_id', Auth::id())->get();
        return view('users.transactions.crypto-transactions', compact('transactions'));
    }
}
