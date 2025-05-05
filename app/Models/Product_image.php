<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_image extends Model
{
    //
    public $timestamps = false;

    public function product_image()
    {
        return $this->hasMany(Product_Image::class);
    }
}
