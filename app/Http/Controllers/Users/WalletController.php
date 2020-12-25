<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use Auth;

class WalletController extends Controller
{
    public static function debit($user_id, $amount)
    {

        if (Auth::user()->wallet()->exists()) {
            $ledger = Auth::user()->wallet;
        }else{
            $ledger = new Wallet();
        }

        $ledger->user_id = $user_id;
        $ledger->debit = $amount;
        $ledger->balance = self::calculateBalance($user_id, 'debit', $amount);
        $ledger->save();

        return;
    }

    public static function credit($user_id, $amount)
    {
        if (Auth::user()->wallet()->exists()) {
            $ledger = Auth::user()->wallet;
        }else{
            $ledger = new Wallet();
        }

        $ledger->user_id = $user_id;
        $ledger->credit = $amount;
        $ledger->balance = self::calculateBalance($user_id, 'credit', $amount);
        $ledger->save();


        return;
    }


    private static function calculateBalance($userId, $ledgerType, $amount)
    {
        $newBalance = 0;
        $amount =$amount;
        $getLastBalance = Wallet::where('user_id', $userId)
                ->get()->last()->balance ?? 0;
        $getLastBalance = $getLastBalance;
        if ($ledgerType === 'debit') {
            $newBalance = $getLastBalance - $amount;
        }
        if ($ledgerType === 'credit') {
            $newBalance = $getLastBalance + $amount;
        }


        return $newBalance;
    }

    private function fixFigre($amount)
    {
      return  rtrim(rtrim(sprintf('%.8F', $amount), '0'), ".");

    }
}
