<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cocktail extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'ordered_ingredients'
    ];
    
    //SQL Relationship
    public function cocktailsingredients() {
        return $this-> belongsTo(CocktailIngredient::class, 'id', 'cocktail_id');
    }

    //Get ordered ingredient with an inner JOIN in the table CocktailIngredients and Ingredients
    public function get_ordered_ingredients(){
        $ordered_ingredients = $this->cocktailsingredients()->orderBy('order', 'asc')->get();
        $ordered_ingredients_array = [];
        foreach($ordered_ingredients as $ordered_ingredient){
            $order = $ordered_ingredient ->order;
            $ordered_ingredient = Ingredient::find($ordered_ingredient->ingredient_id);
            array_push($ordered_ingredients_array, [
                "id" => $ordered_ingredient->id,
                "name" => $ordered_ingredient->name,
                "price" => $ordered_ingredient->price,
                "order" => $order
            ]);
        }
        return $ordered_ingredients_array;
    }
}
