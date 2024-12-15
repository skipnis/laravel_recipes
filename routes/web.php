<?php

use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/recipes', [RecipeController::class, 'indexView'])->name('recipes.index');
Route::get('/recipes/{id}', [RecipeController::class, 'show'])->name('recipes.show');

Route::prefix('favorites')->group(function () {
    Route::post('{recipeId}', [FavoriteController::class, 'addToFavorites'])->name('favorites.add');
    Route::delete('{recipeId}', [FavoriteController::class, 'removeFromFavorites'])->name('favorites.remove');
    Route::get('/', [FavoriteController::class, 'getFavorites']);
});
