<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = "rates";
    protected $guarded = [];

    public function user(){
    	return $this->belongsTo('App\Models\User','user_id');
    }

    public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }
}
