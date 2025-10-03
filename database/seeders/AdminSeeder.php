<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'nafisa@gmail.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('12345'),
                'role' => 'admin',
            ]
        );
    }
}
