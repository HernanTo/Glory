<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function products(){
        return $this->belongsToMany(Product::class, 'order_has_products', 'id_order', 'id_product')
            ->withPivot('price', 'stock', 'discount', 'total_prices');
    }

    public function customer(){
        return $this->hasOne(User::class, 'id', 'id_customer');
    }

}
