<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];

    public function rating()
    {
        return $this->hasMany('App\Models\Rating');
    }

    public function suppor_ticket()
    {
        return $this->hasMany('App\Models\SupportTicket');
    }

    public function offer()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function activity_log()
    {
        return $this->hasMany('App\Models\ActivityLog');
    }

    public function order()
    {
        return $this->hasMany('App\Models\Order');
    }

    public function product()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }


    public function hasRole($roleName)
    {
        return $this->roles->contains('name', $roleName);
    }

    public function cart()
    {
        return $this->hasOne(Cart::class);
    }
}
