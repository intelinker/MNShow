<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'cellphone', 'password', 'vipass', 'authority_id', 'created_at',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function authority() {
        return $this->hasOne('App\Authority', 'id', 'authority_id');
    }


    public function setPasswordAttribute($password) {
        $this->attributes['password'] = Hash::make($password);
    }
}
