<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Chef Ivan',
            'email' => 'ivan@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Chef Olena',
            'email' => 'olena@example.com',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Chef Taras',
            'email' => 'taras@example.com',
            'password' => Hash::make('password123'),
        ]);
    }
}
