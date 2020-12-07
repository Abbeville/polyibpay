<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
