<?php

namespace Database\Seeders;

use App\Models\Sale;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            Sale::create([
                'invoice_number' => 'INV' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'customer_name' => fake()->name(),
                'discount' => rand(0, 10000),
                'total_price' => 0,
            ]);
        }
    }
}
