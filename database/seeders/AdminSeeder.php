<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Kepala OPD',
            'email' => 'opd@gmail.com',
            'role' => 'opd',
            'password' => Hash::make('password')
        ]);
    }
}