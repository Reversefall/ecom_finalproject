<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'username' => 'admin',
            'full_name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'phone_number' => '0123456789',
            'password' => '123456',   
            'role' => 'admin',
            'status' => 1
        ]);

        User::create([
            'username' => 'seller',
            'full_name' => 'Seller User',
            'email' => 'seller@gmail.com',
            'phone_number' => '0123456790',
            'password' => '123456',
            'role' => 'seller',
            'status' => 1
        ]);

        User::create([
            'username' => 'user',
            'full_name' => 'Normal User',
            'email' => 'user@gmail.com',
            'phone_number' => '0123456791',
            'password' => '123456',
            'role' => 'user',
            'status' => 1
        ]);

        User::create([
            'username' => 'moderator',
            'full_name' => 'Moderator User',
            'email' => 'moderator@gmail.com',
            'phone_number' => '0123456792',
            'password' => '123456',
            'role' => 'moderator',
            'status' => 1
        ]);
    }
}
