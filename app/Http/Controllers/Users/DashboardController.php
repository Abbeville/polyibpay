<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\ServiceCategory;
use App\Models\Transaction;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

    	$prefix = Config::get('rave.prefix');
    	$unique = uniqid($prefix.'_');

    	$txref = $unique;

		$wallet_balance = auth()->user()->wallet()->exists() ? auth()->user()->wallet->balance : 0;

        $transactions = $this->transactions();

		$categories = ServiceCategory::pluck('slug');

        foreach ($categories as $key => $value) {
            $$value = ServiceCategory::getBillers($value);
        }
		
        return view('users.dashboard.index', compact('wallet_balance', 'txref', 'airtime', 'tv_subscription', 'electricity', 'data_bundle', 'transactions'));
    }

    private function transactions(){

        $l_week = \Carbon\Carbon::today()->subDays(7);

        $today = Transaction::where('user_id', auth()->id())->whereDate('created_at', Carbon::today())->orderBy('created_at', 'desc')->limit(10)->get();

        $yesterday = Transaction::where('user_id', auth()->id())->whereDate('created_at', Carbon::yesterday())->orderBy('created_at', 'desc')->limit(5)->get();

        $last_month = Transaction::where('user_id', auth()->id())->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->orderBy('created_at', 'desc')->limit(5)->get();

        return [
            'today' => $today,
            'yesterday' => $yesterday,
            'last_month' => $last_month
        ];
    }
}
