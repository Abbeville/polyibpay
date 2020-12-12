<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Alert;

// Models
use App\User;

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
        //
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
        $request->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'phone_number' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        if ($user->userdata) {
            $request->validate([
                'eth_address' => ['required', 'string'],
                'btc_address' => ['required', 'string'],
            ]);
        }

        $user->firstname = $request->input('firstname');
        $user->lastname = $request->input('lastname');
        $user->phone_number = $request->input('phone_number');
        $user->email = $request->input('email');
        $user->save();

        if ($user->userdata) {
            $user->userdata->eth_address = $request->input('eth_address');
            $user->userdata->btc_address = $request->input('btc_address');
            $user->userdata->save();
        }

        if ($user) {
            toast('User Updated Successfully','success');
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
