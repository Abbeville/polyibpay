<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('users.settings.index');
    }

    public function changePassword(){
        return view('users.settings.password');
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

    public function pin(){
        return view('users.settings.pin');
    }

    public function updatePin()
    {
//        dd(request()->all());

        $data = request()->validate([
            'pin' => 'required|min:4|max:4|confirmed',
        ]);

        $pin = Hash::make($data['pin']);
        $user = User::find(auth()->user()->id);

        if($user->pin == ''){
            $user->pin = $pin;
            $user->save();

            session()->flash('success', 'Pin set successfully');
            return redirect('/dashboard');
        }else {
            $check = Hash::check(request('cpin'), $user->pin);
            if ($check) {
                $user->pin = $pin;
                $user->save();

                session()->flash('success', 'Pin set successfully');
                return redirect('/dashboard');
            } else {
                session()->flash('error', 'Incorrect Current Transaction pin');
                return redirect()->back();
            }
        }
    }

//    public function bank(){
//        $data['banks'] = DB::table('banks')->get();
//        return view('users.settings.bank', compact('data'));
//    }


}
