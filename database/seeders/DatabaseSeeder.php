<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\City;
use App\Models\Country;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);

        Country::create(['name' => 'United States']);
        Country::create(['name' => 'United Kingdom']);
        Country::create(['name' => 'Germany']);

        City::create(['country_id' => 1, 'name' => 'New York']);
        City::create(['country_id' => 1, 'name' => 'Washington']);
        City::create(['country_id' => 2, 'name' => 'London']);
        City::create(['country_id' => 2, 'name' => 'Birmingham']);
        City::create(['country_id' => 3, 'name' => 'Berlin']);
        City::create(['country_id' => 3, 'name' => 'Stuttgart']);
    }
}
