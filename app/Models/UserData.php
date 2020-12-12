<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'dob', 'address', 'about', 'country', 'state', 'city', 'zip_code', 'photo', 'photo_url', 'bank_name_id', 'bank_account_name', 'bank_account_number', 'bank_account_type', 'btc_address', 'eth_address',
    ];

    /**
     * User Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
