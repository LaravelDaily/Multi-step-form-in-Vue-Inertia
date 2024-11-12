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

        City::create(['country_id' => 1, 'name' => 'New York', 'adult_price' => 100, 'children_price' => 75]);
        City::create(['country_id' => 1, 'name' => 'Washington', 'adult_price' => 150, 'children_price' => 100]);
        City::create(['country_id' => 2, 'name' => 'London', 'adult_price' => 200, 'children_price' => 175]);
        City::create(['country_id' => 2, 'name' => 'Birmingham', 'adult_price' => 250, 'children_price' => 195]);
        City::create(['country_id' => 3, 'name' => 'Berlin', 'adult_price' => 125, 'children_price' => 85]);
        City::create(['country_id' => 3, 'name' => 'Stuttgart', 'adult_price' => 190, 'children_price' => 155]);
    }
}
