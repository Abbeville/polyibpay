<?php

namespace App\Observers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use App\Http\Controllers\Users\BillController as Bill;

class WalletObserver
{
    /**
     * Handle the wallet "created" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function created(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "updated" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function updated(Wallet $wallet)
    {

        if(session()->has('process_data'))
        {
            $data = session('process_data');

            $request = $request = new Request($data);

            $bill = new Bill();
            $bill->createBill($request);
        }

        // try{

            
            
        // }catch (\Exception $e){
        //     // dd($e);
        //     Log::error($e);
        // }
    }

    /**
     * Handle the wallet "deleted" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function deleted(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "restored" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function restored(Wallet $wallet)
    {
        //
    }

    /**
     * Handle the wallet "force deleted" event.
     *
     * @param  \App\Wallet  $wallet
     * @return void
     */
    public function forceDeleted(Wallet $wallet)
    {
        //
    }
}
