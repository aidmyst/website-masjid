<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jamaah extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabelnya secara eksplisit
    protected $table = 'jamaahs';

    // Izinkan kolom 'nama' untuk diisi melalui create() atau update()
    protected $fillable = ['nama'];
}