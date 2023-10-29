<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = [
        'barcode',
        'num_repuesto',
        'name',
        'price',
        'slug',
        'cost',
        'description',
        'stock',
        'min_stock',
        'available',
        'is_active'
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function images(){
        return $this->hasMany('App\Models\ImageProduct');
    }

    public function categories(){
        return $this->belongsToMany('App\Models\Category', 'product_has_categories');
    }

    public function getImagesMainAttribute(){
        if(($this->images->first() == null)){
            return 'default.png';
        }else{
            return $this->images->first()->photo;
        }
    }

}
