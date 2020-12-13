<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'reference', 'occurred_on', 'category', 'amount', 'narration', 'currency', 'chargecode', 'status',
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
    /**
     * User Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function billInfo()
    {
        return $this->hasOne('App\Models\BillInfo');
    }
    /**
     * User Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function crytoRequest()
    {
        return $this->hasOne('App\Models\CryptoRequest');
    }
    /**
     * Scope a query to only include user status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status)->latest()->get();
    }

    /**
     * Scope a query to only include user status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCategory($query, $category)
    {
        return $query->where('category', $category)->latest()->get();
    }
}
