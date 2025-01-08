<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call the UserSeeder to seed the users table
        $this->call(UserSeeder::class);
    }
}
