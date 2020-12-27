<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{

	protected $fillable = ['user_id', 'unique_address', 'credit', 'debit', 'balance', 'currency_type', 'description'];
	
    public function user(){
    	return $this->belongsTo('App\User');
    }
}