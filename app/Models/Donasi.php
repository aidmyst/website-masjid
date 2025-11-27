<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    use HasFactory;

    protected $fillable = ['donatur_id', 'kategori', 'nominal', 'bukti_tf'];

    public function donatur()
    {
        return $this->belongsTo(Donatur::class, 'donatur_id');
    }
}
