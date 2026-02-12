<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donatur extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['nama', 'no_wa'];
}

