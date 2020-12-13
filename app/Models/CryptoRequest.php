<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CryptoRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'biller_id', 'biller_service', 'service_category', 
    ];


    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }
}
