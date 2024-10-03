<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'f_name',
        'l_name',
        'email',
        'password',
        'phone',
        'gender',
        'os',
        'birthday',
        'nationality',
        'profile_photo',
        'address',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'birthday' => 'date',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class, 'user_id');
    }

    public function favourites()
    {
        return $this->hasMany(Favourite::class, 'user_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id');
    }

    public function serviceRequests()
    {
        return $this->hasMany(ServiceRequest::class, 'user_id');
    }
}