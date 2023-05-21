<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin1234'),
        ])->assignRole('admin','committee');

        User::create([
            'name' => 'Committee',
            'email' => 'committee@example.com',
            'password' => bcrypt('com1234'),
        ])->assignRole('committee');

        User::create([
            'name' => 'Cashier',
            'email' => 'cashier@example.com',
            'password' => bcrypt('cas1234'),
        ])->assignRole('cashier');

    }
}
