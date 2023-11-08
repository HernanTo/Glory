<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_customer',
        'id_seller',
        'IVA',
        'is_paid',
        'subtotal',
        'total',
        'is_active'
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'bills_has_products', 'id_bill', 'id_product')
            ->withPivot('price', 'stock', 'discount', 'total_prices');
    }
    public function services(){
        return $this->hasMany('App\Models\Service', 'id_bill');
    }
    public function customer(){
        return $this->hasOne('App\Models\Customer', 'id', 'id_customer');
    }

    public function seller(){
        return $this->hasOne('App\Models\User', 'id', 'id_seller');
    }

    public function getStateAttribute(){
        if($this->is_paid){
            return 'Pagada';
        }else{
            return 'Pendiente de Pago';
        }
    }

    public function getReferenceAttribute($key)
    {
        return sprintf("%07s", $this->id);
    }

    public function getHaveIVAAttribute()
    {
       return $this->IVA ? 'Incluye' : 'No contiene';
    }
}
