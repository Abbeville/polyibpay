<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Alert;

// Models
use App\Models\Transaction;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $request->input('type');
        $transactions = $this->pick_transaction_type($list);
        return view('admin.transaction.index', [
            'transactions' => $transactions,
            'all_transactions' => Transaction::all(),
            'successful_transactions' => Transaction::status('success'),
            'pending_transactions' => Transaction::status('pending'),
            'failed_transactions' => Transaction::status('failed'),
            'canceled_transactions' => Transaction::status('canceled'),
        ]);
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
    public function show(Transaction $transaction)
    {
        return view('admin.transaction.profile', ['transaction' => $transaction]);
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
     * Update a user status
     *
     * @param  int  $id, status $status
     * @return \Illuminate\Http\Response
     */
    public function change_status(Transaction $transaction, $status)
    {
        $transaction->status = $status;
        $set = $transaction->save();

        if ($set) {
            toast('Transaction Status Changed Successfully','success');
            return redirect()->back();
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        $request->validate([
            'amount' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
        ]);

        $transaction->amount = $request->input('amount');
        $transaction->narration = $request->input('description');
        $transaction->save();

        if ($transaction) {
            toast('Transaction History Updated Successfully','success');
            return redirect()->back();
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        $delete = $transaction->delete();
        if ($delete) {
            toast('Transaction Deleted Successfully','success');
            return redirect()->route('admin.user.index');
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * selecting a category of user from request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pick_transaction_type($type)
    {
        switch ($type) {
            case 'success':
                $transactions = Transaction::status('success');
                $cat = 'Successful';
                break;

            case 'pending':
                $transactions = Transaction::status('pending');
                $cat = 'Pending';
                break;

            case 'failed':
                $transactions = Transaction::status('failed');
                $cat = 'Failed';
                break;

            case 'canceled':
                $transactions = Transaction::status('canceled');
                $cat = 'Cancelled';
                break;

            default:
                $transactions = Transaction::latest()->get();
                $cat = 'All';
                break;
        }
        return ['transactions' => $transactions, 'cat' => $cat];
    }
}
