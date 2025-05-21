<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        
        Category::factory(5)->create()->each(function ($category) {
            // Pra cada categoria, cria 10 produtos relacionados
            Product::factory(10)->create([
                'category_id' => $category->id,
            ]);
        });
    }
}
