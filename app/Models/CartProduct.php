<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartProduct extends Model
{
    use HasFactory;

    // Define la tabla si el nombre no sigue la convención plural
    protected $table = 'cart_products';

    // Especifica los campos que pueden ser asignados masivamente
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
        'total',
    ];

    // Relación con el modelo Cart
    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Relación con el modelo Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
