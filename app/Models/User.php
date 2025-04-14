<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    public function rating(){
        return $this->hasMany('App\Models\Rating');
    }

    public function suppor_ticket(){
        return $this->hasMany('App\Models\SupportTicket');
    }

    public function offer(){
        return $this->hasMany('App\Models\Offer');
    }

    public function activity_log(){
        return $this->hasMany('App\Models\ActivityLog');
    }

    public function order(){
        return $this->hasMany('App\Models\Order');
    }

    public function product(){
        return $this->hasMany('App\Models\Product');
    }

    public function role(){
        return $this->belongsToMany('App\Models\Role');
    }
}