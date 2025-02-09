<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'id' => '9e2ad7bc-12d5-472a-8cf6-c9362ca1c7c7',
                'name' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'type' => 'admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => '9e2ad7f1-86bf-4f09-b857-8e4809b3a9e6',
                'name' => 'User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'type' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}

