<?php

namespace Database\Seeders;

use App\Models\Cocktail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CocktailIngredient;
use App\Models\Ingredient;

class CocktailIngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cocktails_ingredients = [
            [
                'cocktail_id' => 1,
                'ingredient_id' => 1,
                'order' => 1
            ],
            [
                'cocktail_id' => 1,
                'ingredient_id' => 2,
                'order' => 2
            ],
            [
                'cocktail_id' => 1,
                'ingredient_id' => 3,
                'order' => 3
            ],
            [
                'cocktail_id' => 2,
                'ingredient_id' => 6,
                'order' => 1
            ],
            [
                'cocktail_id' => 2,
                'ingredient_id' => 5,
                'order' => 2
            ],
            [
                'cocktail_id' => 2,
                'ingredient_id' => 4,
                'order' => 3
            ],
            [
                'cocktail_id' => 2,
                'ingredient_id' => 1,
                'order' => 4
            ],
            [
                'cocktail_id' => 3,
                'ingredient_id' => 4,
                'order' => 1
            ],
            [
                'cocktail_id' => 3,
                'ingredient_id' => 5,
                'order' => 2
            ],
            [
                'cocktail_id' => 3,
                'ingredient_id' => 2,
                'order' => 3
            ],
            [
                'cocktail_id' => 4,
                'ingredient_id' => 4,
                'order' => 1
            ],
            [
                'cocktail_id' => 4,
                'ingredient_id' => 3,
                'order' => 2
            ],
            [
                'cocktail_id' => 4,
                'ingredient_id' => 5,
                'order' => 3
            ],
        ];

        //Insert data in DB
        foreach ($cocktails_ingredients as $object_cocktails_ingredients) {
            CocktailIngredient::factory()->create($object_cocktails_ingredients);
        }
        

        //Resfresh cocktail price based on ingredients that cocktail has

        try {
            //First search all cocktails id
            foreach (Cocktail::select('id')->distinct()->get() as $cocktail_id) {
                //Variable to save the sum of all ingredients prices
                $sum = 0;
                //For each cocktail find all ingredients that has and sums the price of ingredients
                foreach (Cocktail::find($cocktail_id['id'])->cocktailsingredients()->get() as $cocktails_ingredients) {
                    $sum += Ingredient::find($cocktails_ingredients['ingredient_id'])->price;
                }

                //Save the price in cocktail table
                $cocktail_object = Cocktail::find($cocktail_id['id']);
                $cocktail_object->price = floor($sum * 1.25 * 100) / 100;
                $cocktail_object->save();
            }
        } catch (\Exception $e) {
        
        }

    }
}
