<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    // Pastikan nama tabel benar, jika tidak mengikuti konvensi Laravel (organisasis)
    protected $table = 'organisasi'; 

    protected $fillable = ['gambar'];
}