<?php

namespace App\Http\Controllers\Lib;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Session;
use Auth;

use Rave;
use App\Http\Controllers\Users\WalletController as Wallet;
use App\Http\Controllers\Users\BillController as Bill;

class RaveController extends Controller
{

  /**
   * Initialize Rave payment process
   * @return void
   */
  public function initialize(Request $request)
  {

     Transaction::create([
        'custom_ref' => generateCustomRef(auth()->user()->id),
        'user_id' => auth()->id(),
        'amount' => $request->amount,
        'type' => 'credit',
        'category' => 'wallet',
        'reference' => $request->ref,
        'narration' => 'Recharged wallet with #'.$request->amount,
        'status' => 'pending'
     ]);

    Rave::initialize(route('callback'));
  }

  /**
   * Obtain Rave callback information
   * @return void
   */
  public function callback()
  {
    // dd(json_decode(request()->resp));
    // $resp = Rave::verifyTransaction(json_decode(request()->resp)->data->data->txRef);
    $resp = Rave::verifyTransaction(json_decode(request()->resp)->data->tx->txRef);

    $transaction = Transaction::where('reference', $resp->data->txref)->first();

    if ($resp->status != 'success') {
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
            $data = $resp->data;

          if ($resp->status == 'success' && $data->chargecode == 00 || $data->chargecode == 0 && $data->currency == $currency && $data->amount >= $transaction->amount ) {

            $transaction->status = 'success';
            $transaction->chargecode = $data->chargecode;

            $transaction->save();

            $user = Auth::user();

            /*Update User Wallet*/

            if ($transaction->type == 'credit') {
              Wallet::credit($user->id, $data->amount);
            }else{
              Wallet::debit($user->id, $data->amount);
            }

            if(session()->has('process_data'))
            {
                $data = session('process_data');

                session()->forget('process_data');

                session()->flash('pending_bill', $data);

                return redirect()->route('users.dashboard');
            }

            Session::flash('success', 'Wallet Recharged Succesfully!');
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