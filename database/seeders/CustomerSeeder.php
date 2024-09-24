<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer; // Add this line to import the Customer model

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Use create() to generate and save 50 customer records
        Customer::factory()->count(50)->create();
    }
}
