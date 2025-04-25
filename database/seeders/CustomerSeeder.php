<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Customer::create([
                'name' => fake()->name(),
                'phone' => fake()->phoneNumber(),
                'address' => fake()->address(),
            ]);
        }
    }
}
