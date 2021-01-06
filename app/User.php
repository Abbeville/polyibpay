<?php

namespace App;

use App\Models\CryptoRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Carbon\Carbon;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'ref_id', 'firstname', 'lastname', 'phone_number', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallet(){
        return $this->hasOne('App\Models\Wallet');
    }
    /**
     * Scope a query to only include user status.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeLastMonthNewUsers($query)
    {
        return $query->whereMonth('created_at', '>' , Carbon::now()->subMonth())->latest()->get();
    }
    /**
     * Accessor for getting user fullname
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getFullNameAttribute() {
        return "{$this->firstname} {$this->lastname}";
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
     * UserData Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function userData()
    {
        return $this->hasOne('App\Models\UserData');
    }

    /**
     * User Transactions Relationship
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function cryptoRequest()
    {
        return $this->hasMany(CryptoRequest::class);
    }

    public function vcards()
    {
        return $this->hasMany('App\Models\VirtualCard');
    }
}
