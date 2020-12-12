<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    public static function debit($user_id, $amount, $currency_type, $description)
    {
        $unique_address = $this->generateTxCode();


        if (Auth::user()->wallet()->exists()) {
            $ledger = Auth::user()->wallet;
        }else{
            $ledger = new Wallet();
        }

        $ledger->user_id = $user_id;
        $ledger->debit = $amount;
        $ledger->balance = $this->calculateBalance($user_id, 'debit', $amount, $currency_type);
        $ledger->currency_type = $currency_type;
        $ledger->description = $description;
        $ledger->unique_address = $unique_address;
        $ledger->save();

        return $unique_address;
    }

    public static function credit($user_id, $amount, $currency_type, $description)
    {
        $ref_code = $this->generateTxCode();
        if (Auth::user()->wallet()->exists()) {
            $ledger = Auth::user()->wallet;
        }else{
            $ledger = new Wallet();
        }

        $ledger->user_id = $user_id;
        $ledger->credit = $this->fixFigre($amount);
        $ledger->balance = $this->calculateBalance($user_id, 'credit', $amount, $currency_type);
        $ledger->currency_type = $currency_type;
        $ledger->type = $type;
        $ledger->description = $description;
        $ledger->unique_address = $unique_address;
        $ledger->save();


        return $ref_code;
    }


    private function calculateBalance($userId, $ledgerType, $amount, $currency_type)
    {
        $newBalance = 0;
        $amount =$amount;
        $getLastBalance = Wallet::where('user_id', $userId)
                ->where('currency_type', $currency_type)->get()->last()->balance ?? 0;
        $getLastBalance = $getLastBalance;
        if ($ledgerType === 'debit') {
            $newBalance = $getLastBalance - $amount;
        }
        if ($ledgerType === 'credit') {
            $newBalance = $getLastBalance + $amount;
        }


        return $newBalance;
    }

    private function generateTxCode()
    {
        $lastTxCode = Wallet::latest('id');
        $lastTx = $lastTxCode->value('reference_code');
        if (empty($lastTx)) {
            return 10000001;
        }
        return ++$lastTx;
    }

    private function fixFigre($amount)
    {
      return  rtrim(rtrim(sprintf('%.8F', $amount), '0'), ".");

    }
}
