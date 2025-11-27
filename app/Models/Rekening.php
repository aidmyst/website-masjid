<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rekening extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_bank',
        'nomor_rekening',
        'atas_nama',
        'qris_image',
    ];
}
