<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class HijriDateService
{
    public function getCurrentHijriDate()
    {
        try {
            $response = Http::timeout(5)
                ->withHeaders([
                    'Accept-Encoding' => 'gzip, deflate',
                ])
                ->get(
                    'https://api.aladhan.com/v1/gToH/' . now()->format('d-m-Y')
                );

            if ($response->successful()) {
                $hijri = $response->json('data.hijri');

                return [
                    'day'   => $hijri['day'],
                    'month' => $hijri['month']['en'],
                    'year'  => $hijri['year'],
                ];
            }

            Log::error('Hijri API failed', [
                'status' => $response->status(),
                'body'   => $response->body(),
            ]);
        } catch (\Throwable $e) {
            Log::error('Hijri API exception: ' . $e->getMessage());
        }

        return [
            'day'   => '??',
            'month' => 'Unknown',
            'year'  => '????',
        ];
    }
}
