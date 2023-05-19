<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CocktailIngredient extends Model
{
    use HasFactory;
    public $table = "cocktails_ingredients";
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'cocktail_id',
        'ingredient_id',
        'order',
    ];
    

    //SQL Relationship
    public function ingredients() {
        return $this-> hasMany(Ingredient::class);
    }

    public function cocktails() {
        return $this-> hasMany(Cocktail::class);
    }
}
