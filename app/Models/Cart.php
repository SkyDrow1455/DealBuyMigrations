<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    //
    protected $fillable = [
        'status',
        'total',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'cart_products')
                    ->withPivot('quantity', 'price', 'total') // Campos adicionales en la tabla intermedia
                    ->withTimestamps();
    }
}
