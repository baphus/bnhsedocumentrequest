<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create default admin account
        User::updateOrCreate(
            ['email' => 'admin@bnhs.edu.ph'],
            [
                'name' => 'BNHS Administrator',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'active',
            ]
        );

        // Create default registrar account
        User::updateOrCreate(
            ['email' => 'registrar@bnhs.edu.ph'],
            [
                'name' => 'BNHS Registrar',
                'password' => Hash::make('password'),
                'role' => 'registrar',
                'status' => 'active',
            ]
        );
    }
}
