<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Donatur extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nama', 'no_wa', 'password'];
    protected $hidden = ['password'];
}

