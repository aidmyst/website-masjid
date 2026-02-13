<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Donatur extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nama', 'no_wa'];
}

