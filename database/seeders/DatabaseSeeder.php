<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Announcement;
use App\Models\Inventory;
use App\Models\Item;
use App\Models\Payment;
use App\Models\PaymentDetail;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        Item::factory(15)->create();


        $this->call(RoleSeeder::class);
        $this->call(AdminSeeder::class);

        Announcement::create([
            'title' => 'PETAKOM Mart is closed!',
            'description' => 'Closed on 1 May 2023',
        ]);
        Item::factory(10)->create();
        Payment::factory(10)->create();
        PaymentDetail::factory(20)->create();
        Inventory::factory(10)->create();

    }
}
