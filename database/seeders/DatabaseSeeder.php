<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SizeSeeder::class, 
            CategorySeeder::class, 
            ProductsTableSeeder::class,
            AdminUserSeeder::class,
        ]);
    }
}