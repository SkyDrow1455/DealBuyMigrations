<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function offer(){
        return $this->hasMany('App\Models\Offer');
    }

    public function product_image(){
        return $this->hasMany('App\Models\Product_image');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }
}
