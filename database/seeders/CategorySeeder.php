<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = ['Obat Generik', 'Vitamin', 'Alat Medis', 'Suplemen', 'Salep', 'Obat Tetes', 'Alat Ukur', 'Masker', 'Desinfektan', 'Obat Herbal'];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
