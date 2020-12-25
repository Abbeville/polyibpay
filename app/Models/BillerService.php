<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillerService extends Model
{

	protected $fillable = ['biller_code', 'name', 'is_airtime', 'biller_name', 'fee', 'label_name', 'amount', 'item_code', 'short_name', 'biller_id'];

    public function biller()
    {
    	return $this->belongsTo('App\Models\Biller', 'id', 'biller_id');
    }
}
