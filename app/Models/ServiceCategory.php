<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    public function billers() {
    	return $this->hasMany('App\Models\Biller', 'category_id', 'id');
    }

    public function scopeGetBillers($query, $slug){
    	return $query->where('slug', $slug)->first()->billers;
    }
}
