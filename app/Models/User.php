<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cc',
        'ft_name',
        'sc_name',
        'fi_lastname',
        'sc_lastname',
        'phone_number',
        'address',
        'email',
        'password',
        'pass_change',
        'profile_photo_path',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
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
    public function getAddressCustomerAttribute()
    {
        if($this->address == null){
            return 'No registrada';
        }else{
            return $this->address;
        }
    }
    public function bill(){
        return $this->belongsTo('App\Models\bill');
    }

}
