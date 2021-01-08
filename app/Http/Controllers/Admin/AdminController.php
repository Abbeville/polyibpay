<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Carbon\Carbon;
use DB;
use Alert;
use App\User;
use App\Models\Transaction;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($date = null)
    {

        $sorted_transacts = $this->sort_transaction($date)
                  ->select('category', DB::raw('count(*) as cat_count'))
                  ->groupBy('category')
                  ->get();

        $month = Carbon::now()->month;
        $year = Carbon::now()->year;
        $top_savers = Transaction::where('type', 'credit')
                  ->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year)
                  ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                  ->groupBy('user_id')
                  ->orderBy('total_amount', 'DESC')
                  ->limit(5)
                  ->get();
        $top_debits = Transaction::where('type', 'debit')
                  ->whereMonth('created_at', $month)
                  ->whereYear('created_at', $year)
                  ->select('user_id', DB::raw('SUM(amount) as total_amount'))
                  ->groupBy('user_id')
                  ->orderBy('total_amount', 'DESC')
                  ->limit(5)
                  ->get();
                  
                  // return $arr;
        return view('admin.admin.dashboard',[
            'users' => User::latest()->get(),
            'pending_transactions' => Transaction::status('pending'),
            'transactions' => Transaction::latest()->get(),
            'crypto_transactions' => Transaction::category('crypto')->count(),
            'pending_cryp' => Transaction::where(['category' => 'crypto', 'status' => 'pending'])->latest()->get(),
            'bill_transactions_l' => Transaction::trasactWithLastMonth(Carbon::now()
                                    ->subMonth(1))
                                    ->where(['type' => 'debit', 'status' => 'success'])->sum('amount'),
            'bill_transactions' => Transaction::where(['type' => 'debit', 'status' => 'success'])
                                    ->latest()->get()->sum('amount'),
            'top_up_transactions_l' => Transaction::trasactWithLastMonth(Carbon::now()
                                    ->subMonth(1))
                                    ->where(['type' => 'credit', 'status' => 'success'])->latest()->get()->sum('amount'),
            'top_up_transactions' => Transaction::where(['type' => 'credit', 'status' => 'success'])
                                    ->latest()->get()->sum('amount'),
            'trans' => $sorted_transacts,
            'top_savers' => $top_savers,
            'top_debits' => $top_debits,
        ]);
    }

    /**
     * selecting a category of user from request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sort_transaction($date)
    {
        switch ($date) {
            case 'today':
                $transactions = Transaction::trasactWithPeriod(Carbon::today());
                break;

            case 'week':
                $transactions = Transaction::trasactWithPeriod(Carbon::today()->subDays(7));
                break;

            case 'month':
                $transactions = Transaction::trasactWithPeriod(Carbon::now()->subMonth(1));
                break;

            case '3months':
                $transactions = Transaction::trasactWithPeriod(Carbon::now()->subMonth(3));
                break;

            default:
                $transactions = Transaction::trasactWithPeriod(Carbon::now()->subMonth());
                break;
        }
        return $transactions;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
