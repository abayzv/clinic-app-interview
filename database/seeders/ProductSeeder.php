<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id')->toArray();

        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Produk ' . $i,
                'sku' => 'PRD' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'category_id' => fake()->randomElement($categories),
                'stock' => rand(10, 100),
                'price' => rand(5000, 100000),
                'unit' => fake()->randomElement(['pcs', 'box', 'botol']),
            ]);
        }
    }
}
