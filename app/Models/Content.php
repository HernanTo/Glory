<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_type',
        'path'
    ];

    public function typeContent(){
        $this->belongsTo(typeContent::class, 'id_type');
    }
}
