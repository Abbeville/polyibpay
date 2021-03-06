<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CryptoRequest extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transaction_id', 'amount_crypto', 'type', 'user_id',
        'request_id', 'proof_file', 'hash_code', 'amount_usd', 'amount_ngn',
        'current_rate'
    ];


    public function transaction(){
        return $this->belongsTo('App\Models\Transaction');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
