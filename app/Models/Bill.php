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
        return $this->belongsToMany('App\Models\Product', 'bills_has_products');
    }
    public function services(){
        return $this->hasMany('App\Models\Service');
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
}
