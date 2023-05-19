<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;
use App\Models\Ingredient;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            //Get ingredients from API
            $response = Http::get('http://www0.ims-spain.com/cocktail.json');
            //If receive a valid response inserts ingredients data on DB
            if ($response->status() == 200){
                $ingredients = $response->json();
                foreach ($ingredients['ingredients'] as $key => $value) {
                    Ingredient::factory()->create([
                        'name' => $key,
                        'price' => $value[0]['price'],
                    ]);
                }
            }
        } catch (\Exception $e) {
        
        }

    }
}
