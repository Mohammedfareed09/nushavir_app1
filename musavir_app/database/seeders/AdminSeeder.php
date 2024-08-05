<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create(
            [
                User::create([
                    'full_name' => 'Admin User',
                    'phone' => '+905366929316',
                    'tc' => '99553879768',
                    'email' => 'admin@gmail.com',
                    'email_verified_at' => now(),
                    'password' => '11223344',
                    'avatar_path' => '',
                    'verification_code' => Str::random(4),
                    'code_expiry' => now()->addMinutes(2),
                    'token' => Str::random(64), // Add this line
                  ])->assignRole('Admin'),
            ]
        );
        $user->assignRole('Manager' ,'Admin');
    }
}
