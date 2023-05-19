<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CocktailController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\IngredientController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/login', [AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(CocktailController::class)->group(function () {
        Route::get('/cocktail',  'index');
        // Route::get('/cocktail/create',  'create');
        // Route::post('/cocktail',  'store');
        // Route::get('/cocktail/{id}', 'show');
        // Route::get('/cocktail/{id}/edit', 'show');
        // Route::put('cocktail/{id}', 'update');
        // Route::delete('cocktail/{id}', 'destroy');
        Route::post('/cocktail/elaborateCocktail', 'elaborateCocktail');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::post('/getCartPrice', 'getCartPrice');
        Route::post('/completePurchases', 'completePurchases');
        // Route::get('/order',  'index');
        // Route::get('/order/create',  'create');
        Route::post('/order',  'store');
        // Route::get('/order/{id}', 'show');
        // Route::get('/order/{id}/edit', 'show');
        // Route::put('order/{id}', 'update');
        // Route::delete('order/{id}', 'destroy');
    });
    
    Route::controller(IngredientController::class)->group(function () {
        Route::get('/ingredient',  'index');
        // Route::get('/ingredient/create',  'create');
        // Route::post('/ingredient',  'store');
        // Route::get('/ingredient/{id}', 'show');
        // Route::get('/ingredient/{id}/edit', 'show');
        // Route::put('ingredient/{id}', 'update');
        // Route::delete('ingredient/{id}', 'destroy');
        
    });
});
