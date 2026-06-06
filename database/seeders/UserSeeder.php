<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'username' => 'superadmin',
            'email' => 'superadmin@masjid.local',
            'password' => Hash::make('SuperAdmin123!'),
            'role' => 'superadmin',
        ]);

        User::create([
            'name' => 'Admin Bendahara',
            'username' => 'bendahara',
            'email' => 'bendahara@masjid.local',
            'password' => Hash::make('Password123'),
            'role' => 'admin',
        ]);
    }
}
