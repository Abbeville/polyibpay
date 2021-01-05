<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Alert;

// Models
use App\User;
use App\Models\UserData;
use App\Models\Wallet;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $list = $request->input('type');
        $users = $this->pick_user_type($list);
        return view('admin.user.index', [
            'users' => $users,
            'all_users' => User::all(),
            'new_users' => User::LastMonthNewUsers(),
            'active_users' => User::status('active'),
            'inactive_users' => User::status('inactive'),
            'suspended_users' => User::status('suspended'),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);


        $user = User::create([
            'user_id' => generateUserId(),
            'status' => $request->input('status'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'phone_number' => $request->input('phone_number'),
            'ref_id' => '1000000',
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
        ]);

        $user->wallet()->create([
            'unique_address' => generateWalletId(),
            'credit' => 0,
            'debit' => 0,
            'balance' => 0
        ]);

        $user->userData()->create([
            'user_id' => $user->id
        ]);

        if ($user) {
            toast('User Account has been Credited Successfully','success');
            return redirect()->back();
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::where('id', $user)->with(['userData', 'wallet', 'transactions'])->first();
        return view('admin.user.profile', ['user' => $user]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_wallet($user)
    {
        $user = User::where('id', $user)->with(['userData', 'wallet', 'transactions'])->first();
        return view('admin.user.wallet', ['user' => $user]);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_virtual_card($user)
    {
        $user = User::where('id', $user)->with(['userData', 'wallet', 'transactions', 'vcards'])->first();
        return view('admin.user.vcard', ['user' => $user]);
    }

    /**
     * Add to the specified resource wallet balance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wallet_deposit(Request $request, $user)
    {
        $request->validate([
            'deposit_amount' => ['required', 'integer']
        ]);

        $amount = $request->input('deposit_amount');

        $update = Wallet::where('user_id',$user)->increment('credit', $amount);
        $update = Wallet::where('user_id',$user)->increment('balance', $amount);

        if ($update) {
            toast('User Wallet has been Credited Successfully','success');
            return redirect()->back();
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();

    }

    /**
     * Debit action to the specified resource wallet balance.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wallet_withdrawal(Request $request, User $user)
    {
        $request->validate([
            'withdrawal_amount' => ['required', 'integer']
        ]);

        $amount = $request->input('withdrawal_amount');

        if ($user->wallet->balance > $amount) { 
            $update = Wallet::where('user_id',$user->id)->increment('debit', $amount);
            $update = Wallet::where('user_id',$user->id)->decrement('balance', $amount);

            if ($update) {
                toast('User Wallet has been Debited Successfully','success');
                return redirect()->back();
            }

            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }
        toast('Operation Failed, User balance is insufficient!','error');
        return redirect()->back();
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
    public function update(Request $request, User $user)
    {
        if ($request->input('detail') == 'personaldetails') {

            $user->firstname = $request->input('firstname');
            $user->lastname = $request->input('lastname');
            $user->email = $request->input('email');
            $user->phone_number = $request->input('phone_number');
            $user->save();

            $userdetails = UserData::updateOrCreate([
                'user_id' => $user->id
            ],[
                'dob' => $request->input('dob'),
                'about' => $request->input('about'),
                'address' => $request->input('address'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zip_code' => $request->input('zip_code'),
                'country' => $request->input('country_id'),
            ]);
            $userdetails->save();

            if ($user && $userdetails) {
                toast('User Account Updated Successfully','success');
                return redirect()->back();
            }

            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($request->input('detail') == 'bankdetails') {

            $userdetails = UserData::updateOrCreate([
                'user_id' => $user->id
            ],[
                'bank_name_id' => $request->input('bank_name_id'),
                'bank_account_name' => $request->input('bank_account_name'),
                'bank_account_number' => $request->input('bank_account_number'),
                'bank_account_type' => $request->input('bank_account_type'),
            ]);
            $userdetails->save();

            if ($userdetails) {
                toast('User Account Updated Successfully','success');
                return redirect()->back();
            }

            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

        if ($request->input('detail') == 'wallletsdetails') {

            $userdetails = UserData::updateOrCreate([
                'user_id' => $user->id
            ],[
                'btc_address' => $request->input('btc_address'),
                'eth_address' => $request->input('eth_address'),
            ]);
            $userdetails->save();

            if ($userdetails) {
                toast('User Account Updated Successfully','success');
                return redirect()->back();
            }

            toast('Operation Failed, Please Retry!','error');
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //delete user, userdata, bank, wallet

        // Check user wallet balance before deleting
        if ($user->userdata) {
            $delete = $user->userdata->delete();
        }

        $delete = $user->delete();

        if ($delete) {
            toast('User Record Deleted Successfully','success');
            return redirect()->route('admin.user.index');
        }

        toast('Operation Failed, Please Retry!','error');
        return redirect()->back();
    }
    /**
     * Update a user status
     *
     * @param  int  $id, status $status
     * @return \Illuminate\Http\Response
     */
    public function change_status(User $user, $status)
    {
        $user->status = $status;
        $user->save();

        toast('User Status Changed Successfully','success');
        return redirect()->back();
    }

    /**
     * selecting a category of user from request.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function pick_user_type($type)
    {
        switch ($type) {
            case 'active':
                $users = User::status('active');
                $cat = 'Active';
                break;

            case 'inactive':
                $users = User::status('inactive');
                $cat = 'Inactive';
                break;

            case 'suspended':
                $users = User::status('suspended');
                $cat = 'Suspended';
                break;

            default:
                $users = User::latest()->get();
                $cat = 'All';
                break;
        }
        return ['users' => $users, 'cat' => $cat];
    }
}
