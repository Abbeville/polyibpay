<?php

use Illuminate\Support\Facades\DB;
use App\Models\NigeriaState;
use App\Models\BankName;

function generateUserId()
{
    //get last ID
    $lastId = \App\User::all()->last();
    if ($lastId) {
        $lastUserId = (int)$lastId->user_id;
        $newUserId = $lastUserId++;
    } else {
        $newUserId = 1000001;
    }
    return $newUserId;
}

function getBankName($id){
    $bank = DB::table('bank_names')->where('id', $id)->first();
    return $bank->bank_name;
}

function getStates(){
    $states = NigeriaState::all();
    return $states;
}

function getAllBanks(){
    $bank = Bankname::all();
    return $bank;
}

function getBank($code){
    $bank = DB::table('bank_names')->where('code', $code)->first();
    return $bank;
}
