<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'password' => '12345678',
        ]);

        User::create([
            'name' => 'Employee',
            'email' => 'employee@example.com',
            'password' => '12345678',
        ]);

        User::create([
            'name' => 'Customer',
            'email' => 'client@example.com',
            'password' => '12345678',
        ]);
    }
}
