<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Cocktail;
use App\Models\CocktailIngredient;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CocktailSeeder::class,
            IngredientSeeder::class,
            UserSeeder::class,
            OrderSeeder::class,
            CocktailIngredientSeeder::class,
        ]);
    }
}
