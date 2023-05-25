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
            'name' => 'AdminCommittee',
            'email' => 'adminCommittee@example.com',
            'password' => bcrypt('ac1234'),
        ])->assignRole('admin','committee');

        User::create([
            'name' => 'Committee',
            'email' => 'committee@example.com',
            'password' => bcrypt('com1234'),
        ])->assignRole('committee');

        User::create([
            'name' => 'CashierCommittee',
            'email' => 'cashierCommittee@example.com',
            'password' => bcrypt('cc1234'),
        ])->assignRole('cashier','committee');

        User::create([
            'name' => 'Coordinator',
            'email' => 'coordinator@example.com',
            'password' => bcrypt('coor1234'),
        ])->assignRole('coordinator');

    }
}
