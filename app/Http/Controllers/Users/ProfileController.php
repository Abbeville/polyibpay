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
//        return view('')
    }


    public function editProfile(){
        return view('users.profile.edit');
    }



    public function updateBank(){
        return view('users.profile.bank');
    }

}
