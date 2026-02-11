<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where('email', 'jamiaisyah125@gmail.com')->first();

        if (!$user) {
            User::create([
                'name' => 'Admin Masjid',
                'email' => 'jamiaisyah125@gmail.com',
                'password' => Hash::make('jamiaisyah125@'), 
                'email_verified_at' => now(),
            ]);
        }
    }
}