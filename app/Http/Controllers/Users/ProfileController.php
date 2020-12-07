<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.profile.index');
    }

    public function editProfile(){
        return view('users.profile.edit');
    }

    public function changePassword(){
        return view('users.profile.password');
    }

    public function updateBank(){
        return view('users.profile.bank');
    }

    public function updatePassword(){

        $data = request()->validate([
           'current-password' => 'required',
           'password' => 'required|min:8|confirmed'
        ]);

        $old = Hash::make($data['current-password'], [ 'rounds' => 10]);
//        dd([$old, auth()->user()->getAuthPassword(), $data['current-password'], $data['password']]);
        $is_same = Hash::check($data['current-password'], auth()->user()->getAuthPassword());
        if(!$is_same){
            session()->flash('error', 'Incorrect password. Kindly enter the valid current password');
            return redirect()->back();
        }else{

            $password = Hash::make($data['password']);
            $user = User::find(auth()->user()->id);
            $user->password = $password;
            $user->save();
            session()->flash('success', 'Password changed successfully');

            return redirect('/dashboard');
        }

    }
}
