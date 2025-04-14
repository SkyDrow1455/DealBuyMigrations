<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function order_detail(){
        return $this->hasOne('App\Models\Order_detail');
    }
    
}
