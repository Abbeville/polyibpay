<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualCard extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'card_id', 'account_id', 'cedits', 'debits', 'balance', 'name_on_card', 'expiration', 'cvv', 'is_active', 'card_pan', 'masked_pan', 'card_type', 'billing_address', 'billing_country', 'billing_state', 'billing_city', 'billing_zip_code', 'currency',
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
     * Transactions Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction', 'vcard_id');
    }

    /**
     * Scope a query to only include user status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status)->latest()->get();
    }
}
