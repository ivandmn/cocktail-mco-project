<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
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
        'image',
    ];

    //SQL Relationship
    public function cocktailsingredients() {
        return $this-> belongsTo(CocktailIngredient::class, 'id', 'ingredient_id');
    }
}
