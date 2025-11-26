<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class HijriDateService
{
    public function getCurrentHijriDate()
    {
        try {
            $response = Http::get('https://api.aladhan.com/v1/gToH', ['date' => now()->format('d-m-Y')]);

            if ($response->successful()) {
                $data = $response->json()['data']['hijri'];
                return [
                    'day'   => $data['day'],
                    'month' => $data['month']['en'],
                    'year'  => $data['year'],
                ];
            }
        } catch (\Exception $e) {
            // Jika API gagal, kembalikan nilai default
        }

        return [
            'day'   => '??',
            'month' => 'Unknown',
            'year'  => '????',
        ];
    }
}