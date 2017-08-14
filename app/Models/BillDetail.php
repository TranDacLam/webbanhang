<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    protected $table = "bill_details";
    protected $guarded = [];

    public function product(){
    	return $this->belongsTo('App\Models\Product','product_id');
    }

    public function bill(){
    	return $this->belongsTo('App\Models\Bill','bill_id');
    }
}
