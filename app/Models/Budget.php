<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_seller',
        'IVA',
        'subtotal',
        'total',
        'is_active'
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'budgets_has_products', 'id_budget', 'id_product')
            ->withPivot('price', 'stock', 'discount', 'total_prices');
    }

    public function customer(){
        return $this->hasOne('App\Models\Customer', 'id', 'id_customer');
    }

    public function seller(){
        return $this->hasOne('App\Models\User', 'id', 'id_seller');
    }

    public function getReferenceAttribute()
    {
        return sprintf("%06s", $this->id);
    }

    public function getHaveIVAAttribute()
    {
       return $this->IVA ? 'Incluye' : 'No contiene';
    }

}
