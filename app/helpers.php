<?php


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

function generateWalletId()
{
	//get last ID
	$lastId = \App\Models\Wallet::all()->last();
	if ($lastId) {
	    $lastWalletId = (int)$lastId->id;
	    $newWalletId = 'W-00'.$lastWalletId++;
	} else {
	    $newWalletId = 'W-001';
	}
	return $newWalletId;
}

function generateTransactionRef(){
	$prefix = Config::get('rave.prefix');
	$overrideRefWithPrefix = false;

	$transactionPrefix = $prefix . '_';
	$overrideTransactionReference = $overrideRefWithPrefix;

	if ($overrideTransactionReference) {
	    $txref = $transactionPrefix;
	} else {
	    $txref = uniqid($transactionPrefix);
	}

	return $txref;
}