<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypePay extends Model
{
    use HasFactory;

    protected $fillable = ['name','is_active'];

    public function bills(){
        return $this->hasMany(Bill::class, 'id_type_pay', 'id');
    }
}
