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
}
