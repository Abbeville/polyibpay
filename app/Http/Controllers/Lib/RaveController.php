<?php

namespace App\Http\Controllers\Lib;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Session;
use Auth;

use Rave;
use App\Http\Controllers\Users\WalletController as Wallet;

class RaveController extends Controller
{

  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize(Request $request)
  {

     Transaction::create([
        'user_id' => auth()->id(),
        'amount' => $request->amount,
        'type' => $request->type,
        'category' => $request->category,
        'reference' => $request->txref,
        'narration' => 'Recharged wallet with {$request_amount}',
        'status' => 'pending',
        'currency' => 'NGN'
     ]);

    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback()
  {

    $res = Rave::verifyTransaction(request()->txref);

    $transaction = Transaction::where('reference', request()->txref)->first();

    if (request()->cancelled) {
      $transaction->status = 'failed';

      $transaction->save();

      Session::flash('danger', '<strong>ERROR:</strong> Payment not Completed.');
      return redirect()->route('users.dashboard');
    }else{

        $amount = $transaction->amount;
        $currency = $transaction->currency;

        if ($transaction->status == 'success') {
          Session::flash('success', 'Wallet Recharged successful');
          return redirect()->route('users.dashboard');
        }else{
            $data = $res->data;

          if ($res->status == 'success' && $data->chargecode == 00 || $data->chargecode == 0 && $data->currency == $currency && $data->amount) {

            $transaction->status = 'success';
            $transaction->chargecode = $data->chargecode;

            $transaction->save();

            $user = Auth::user();

            /*Update User Wallet*/

            if ($request->type == 'credit') {
              Wallet::credit($user->id, $data->amount, $data->currency, $transaction->description);
            }else{
              Wallet::debit($user->id, $data->amount, $data->currency, $transaction->description);
            }

            Session::flash('success', 'Wallet Recharged Succesful!');
            return redirect()->route('users.dashboard');

          }else{

            $transaction->status = 'failed';
            $transaction->chargecode = $data->chargecode;

            $transaction->save();

            Session::flash('error', 'Transaction Failed! Please try again');
            return redirect()->route('users.dashboard');
          }

        }
    }
  }
}