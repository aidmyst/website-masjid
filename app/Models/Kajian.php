<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Kajian extends Model
{
    use HasFactory;

    protected $table = 'kajian';

    protected $casts = [
        'hari' => 'date',
    ];

    protected $fillable = [
        'hari',
        'waktu',
        'tema',
        'pemateri',
    ];

    public function getStatusAttribute()
    {
        $now = Carbon::now('Asia/Jakarta');
        $eventDate = Carbon::parse($this->hari)->timezone('Asia/Jakarta');

        // JIka tanggal masih di masa depan
        if ($eventDate->isFuture()) {
            return 'Segera';
        }

        // Jika tanggal sudah lewat
        if ($eventDate->isPast() && !$eventDate->isToday()) {
            return 'Selesai';
        }

        // ---- Jika Hari Ini ----
        if ($eventDate->isToday()) {

            preg_match_all('/(\d{1,2})[:.](\d{2})/', $this->waktu, $matches);

            if (isset($matches[0]) && count($matches[0]) > 0) {
                $startStr = str_replace('.', ':', $matches[0][0]);
                $startTime = Carbon::parse($eventDate->format('Y-m-d') . ' ' . $startStr);

                // Jika ada dua waktu → pakai sebagai rentang.
                // Jika hanya satu → endTime = startTime (tanpa durasi auto)
                $endTime = count($matches[0]) > 1
                    ? Carbon::parse($eventDate->format('Y-m-d') . ' ' . str_replace('.', ':', end($matches[0])))
                    : $startTime;

                if ($now->lt($startTime)) return 'Segera';
                if ($now->between($startTime, $endTime)) return 'Sedang Berlangsung';
                if ($now->gt($endTime)) return 'Selesai';
            }
        }


        return 'Segera';
    }
}
