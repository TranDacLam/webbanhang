<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'facebook_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function rates(){
        return $this->hasMany('App\Models\Rate');
    }

    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }

    public function bills(){
        return $this->hasMany('App\Models\Bill');
    }
}
