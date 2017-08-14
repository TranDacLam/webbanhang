<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = "bills";
    protected $guarded = [];

    public function bill_details(){
    	return $this->hasMany('App\Models\BillDetail');
    }

    public function customer(){
    	return $this->belongsTo('App\Models\Customer','customer_id');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User','user_id');
    }
}
