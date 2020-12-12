<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'bank_name', 'code', 'slug', 'status', 
    ];
}
