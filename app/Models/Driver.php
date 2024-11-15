<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Driver extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'license', 'vehicle', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
