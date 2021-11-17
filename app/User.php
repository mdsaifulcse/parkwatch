<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const SUPERADMIN='superadmin';
    const ADMIN='admin';
    const PARKING_OWNER='parkingowner';


    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'password','photo','user_role','place_id','status','password_reset_otp','otp_validity','otp_status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasRole($role)
    {  
        return ($this->user_role == $role);
    } 

    public function place_id()
    {  
        return (!empty($this->place_id)?explode(",", $this->place_id):[]);
    }


}
