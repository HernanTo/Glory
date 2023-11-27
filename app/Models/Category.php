<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nameV',
        'photo_category',
        'is_active'
    ];

    public function products(){
        return $this->belongsToMany('App\Models\Product', 'product_has_categories');
    }

}
