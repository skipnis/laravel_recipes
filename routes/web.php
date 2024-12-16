<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\ReviewController;
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

Route::middleware('auth')->prefix('reviews')->group(function () {
    Route::post('/', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/{recipeId}', [ReviewController::class, 'index'])->name('reviews.index');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/categories/name/{name}', [CategoryController::class, 'findByName'])->name('categories.findByName');
});

Route::get('/categories/{id}/recipes', [CategoryController::class, 'getRecipesByCategoryId'])->name('categories.show');

Route::post('/form/recipes', [RecipeController::class, 'create'])->name('recipes.create');
Route::get('/form/recipes', [RecipeController::class, 'showCreateForm'])->name('recipes.store');
