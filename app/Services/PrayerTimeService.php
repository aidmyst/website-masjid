<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class PrayerTimeService
{
    protected $prayerTimes = [];
    protected $nextPrayerName = null;
    protected $today;

    public function __construct()
    {
        $this->today = Carbon::now('Asia/Jakarta');
        $this->fetchPrayerTimes();
    }

    protected function fetchPrayerTimes()
    {
        try {
            $response = Http::get('https://api.aladhan.com/v1/timingsByCity', [
                'city'    => 'Sukoharjo',
                'country' => 'Indonesia',
                'method'  => 8, // Kemenag RI
            ]);

            if ($response->successful() && isset($response->json()['data']['timings'])) {
                $apiTimings = $response->json()['data']['timings'];

                $this->prayerTimes = [
                    'Subuh'   => $apiTimings['Fajr'],
                    'Dzuhur'  => $apiTimings['Dhuhr'],
                    'Ashar'   => $apiTimings['Asr'],
                    'Maghrib' => $apiTimings['Maghrib'],
                    'Isya'    => $apiTimings['Isha'],
                ];
                $this->determineNextPrayer();
            }
        } catch (\Exception $e) {
            // Biarkan array kosong jika API gagal
            $this->prayerTimes = [];
        }
    }

    protected function determineNextPrayer()
    {
        foreach ($this->prayerTimes as $name => $time) {
            $prayerTime = Carbon::createFromTimeString($time, 'Asia/Jakarta');
            if ($this->today->lessThan($prayerTime)) {
                $this->nextPrayerName = $name;
                return;
            }
        }
        $this->nextPrayerName = 'Subuh (Besok)';
    }
    
    public function getTodaysPrayerTimes()
    {
        return $this->prayerTimes;
    }

    public function getNextPrayerName()
    {
        return $this->nextPrayerName;
    }

    public function getFormattedDate()
    {
        Carbon::setLocale('id');
        return $this->today->translatedFormat('l, j F Y');
    }
}