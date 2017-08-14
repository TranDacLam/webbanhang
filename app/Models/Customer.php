<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = "customer";
    protected $guarded = [];

    public function bills(){
    	return $this->hasMany('App\Models\Bill');
    }
}
