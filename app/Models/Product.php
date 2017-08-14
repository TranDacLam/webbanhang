<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded = [];

    public function category(){
    	return $this->belongsTo('App\Models\Category','category_id');
    }

    public function bill_details(){
    	return $this->hasMany('App\Models\BillDetail');
    }

    public function rates(){
    	return $this->hasMany('App\Models\Rate');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
