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
