<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalKhatib extends Model
{
    use HasFactory;

    protected $fillable = ['jumat_1', 'jumat_2', 'jumat_3', 'jumat_4', 'jumat_5'];
}
