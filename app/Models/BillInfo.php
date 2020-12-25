<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillInfo extends Model
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

    public function biller(){
        return $this->belongsTo('App\Models\Biller');
    }

    public function billerService(){
        return $this->belongsTo('App\Models\BillerService');
    }

}
