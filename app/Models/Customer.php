<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'cc',
        'ft_name',
        'sc_name',
        'fi_lastname',
        'sc_lastname',
        'phone_number',
        'address',
        'email',
        'profile_photo_path',
        'is_active'
    ];

    public function getFullNameAttribute()
    {
        return $this->ft_name . " " . $this->sc_name . " " . $this->fi_lastname . " " . $this->sc_lastname . " ";
    }

    public function getNameLastAttribute()
    {
        return $this->ft_name . " " . $this->fi_lastname;
    }

    public function getEmailVAttribute()
    {
        if($this->email == ''){
            return 'No tiene';
        }else{
            return $this->email;
        }
    }

    public function getprofileImgAttribute()
    {
        if($this->profile_photo_path == null){
            return 'default.png';
        }else{
            return $this->profile_photo_path;
        }
    }

    public function bill(){
        return $this->belongsTo('App\Models\Bill');
    }
}
