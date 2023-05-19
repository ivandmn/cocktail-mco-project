<?php

namespace Database\Seeders;

use App\Models\Cocktail;
use App\Models\Ingredient;
use App\Models\CocktailIngredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CocktailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cocktails = [
            // [
            //     'name' => 'Caipirinha',
            //     'price' => 3.87
            // ],
            // [
            //     'name' => 'Long Island Iced Tea',
            //     'price' => 6
            // ],
            // [
            //     'name' => 'Soulbreaker',
            //     'price' => 3.75
            // ],
            // [
            //     'name' => 'Love Journey Iced',
            //     'price' => 3.75
            // ]
            [
                'name' => 'Caipirinha',
            ],
            [
                'name' => 'Long Island Iced Tea',
            ],
            [
                'name' => 'Soulbreaker',
            ],
            [
                'name' => 'Love Journey Iced',
            ]
            
        ];

        foreach ($cocktails as $cocktail) {
            Cocktail::factory()->create($cocktail);
        }
    }
}
