<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	protected $fillable = ['user_id', 'amount', 'type', 'category', 'reference', 'narration', 'status'];
	
    public function bill(){
    	return $this->hasOne('App\Models\BillTransaction');
    }
}
