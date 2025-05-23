<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'description', 'price', 'condition', 'category_id']; // Agrega 'category_id'

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function offer()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function product_image()
    {
        return $this->hasMany('App\Models\Product_image');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

<<<<<<< HEAD
    public function product_images()
    {
    return $this->hasMany('App\Models\Product_image'); // Asegúrate de tener este modelo
   }

    public function offers()
   {
    return $this->hasMany('App\Models\Offer');
   }
   
=======
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products')
            ->withPivot('quantity', 'price', 'total')
            ->withTimestamps();
    }
>>>>>>> 907ed6621f79880d93029905068df9ccfa07b259
}
