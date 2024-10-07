<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Import the Hash facade

class AdminTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('admins')->insert([
            [
                'email' => 'boniamin4444@gmail.com',
                'password' => Hash::make('password123'), // Use Hash::make()
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'email' => 'boniamin4444@gmail.com',
                'password' => Hash::make('password456'), // Use Hash::make()
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
