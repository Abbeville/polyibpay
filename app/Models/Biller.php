<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Biller extends Model
{

	protected $fillable = ['name', 'biller_code', 'category_id', 'thumbnail_path']; 

    public function category() {
    	return $this->belongsTo('App\Models\ServiceCategory', 'id', 'category_id');
    }

    public function services()
    {
    	return $this->hasMany('App\Models\BillerServices', 'id', 'biller_id');
    }
}
