<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillTransaction extends Model
{
	protected $fillable = ['transaction_id', 'customer_number', 'biller_name', 'amount', 'type', 'item_code'];
	
    public function transaction(){
    	return $this->belongsTo('App\Models\Transaction');
    }
}
