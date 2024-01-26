<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContent extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];

    public function content(){
        $this->hasMany(Content::class, 'id_type');
    }
}
