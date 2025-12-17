<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // PENTING: Untuk enkripsi password

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Cek dulu apakah user sudah ada biar tidak error duplicate entry
        // jika seeder dijalankan berulang kali
        $user = User::where('email', 'jamiaisyah125@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Admin Masjid',
                'email' => 'jamiaisyah125@gmail.com',
                // Password wajib di-Hash! Jangan tulis plain text.
                'password' => Hash::make('jamiaisyah125@'), 
                'email_verified_at' => now(),
            ]);
        }
        
        // Opsional: Buat dummy user lain jika perlu
        // User::factory(5)->create();
    }
}