<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'total'
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'shopping_carts_has_products', 'id_cart', 'id_product')
            ->withPivot('price', 'stock', 'total_prices');
    }
    public function shoppingCart(){
        return $this->belongsTo('App\Models\User', 'user');
    }
}
