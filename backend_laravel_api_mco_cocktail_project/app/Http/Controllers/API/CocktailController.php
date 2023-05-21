<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Cocktail;
use App\Models\CocktailIngredient;
use App\Models\Ingredient;
use Illuminate\Http\Request;

class CocktailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cocktails = Cocktail::all(['id', 'name', 'price']);
        foreach ($cocktails as $cokctail) {
            $cokctail->ingredients = $cokctail->get_ordered_ingredients();
        }
        return $cocktails;
    }

    /**
     * Return cocktail if cocktail is elaborted correctly with the ingredients in order
     */
    public function elaborateCocktail(Request $request)
    {
        $ingredientsArray = $request->all();
        $arrayIdIngredients = [];
        foreach ($ingredientsArray as $ingredient) {
            array_push($arrayIdIngredients, $ingredient['id']);
        }
        foreach (Cocktail::all() as $cocktail) {
            $is_the_cocktail = true;
            foreach(Cocktail::find($cocktail->id)->cocktailsingredients()->get() as $cocktailingredients){
                if(!in_array($cocktailingredients->ingredient_id, $arrayIdIngredients)){
                    $is_the_cocktail = false;
                }
            };
            if($is_the_cocktail){
                $count = 1;
                $final_cocktail = true;
                foreach($arrayIdIngredients as $idingredients){
                    $cookieIngredientProduct = CocktailIngredient::where('ingredient_id', $idingredients)->where('cocktail_id',$cocktail->id)->first();
                    if($cookieIngredientProduct->order == $count){
                        $count++;
                    } else {
                        $final_cocktail = false;
                    }
                }
                if($final_cocktail){
                    $returned_cocktail = Cocktail::find($cocktail->id);
                    $returned_cocktail->ingredients = $returned_cocktail->get_ordered_ingredients();
                    return $returned_cocktail;
                }
            }

        }

        return null;
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update()
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {

    }
}
