<?php

namespace App\Models;

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
        'name',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'address',
        'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function social_account()
    {
        return $this->hasOne('App\Models\Social_account');
    }

    public function bookings()
    {
        return $this->hasMany('App\Models\Booking');
    }

    public function ratings()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function likes()
    {
        return $this->hasMany('App\Models\Like');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function isAdministrator()
    {
        return $this->getAttribute('is_admin');
    }
}
