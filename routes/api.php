<?php

use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CousineController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\InstructionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('/recipes')->group(function () {
    Route::get('/', [RecipeController::class, 'index']);
    Route::get('/{id}', [RecipeController::class, 'show']);
    Route::get('/category/{categoryId}', [RecipeController::class, 'findByCategory']);
    Route::get('/author/{authorId}', [RecipeController::class, 'findByAuthor']);
    Route::get('/name/{name}', [RecipeController::class, 'findByName']);
    Route::post('/', [RecipeController::class, 'create']);
    Route::put('/{id}', [RecipeController::class, 'update']);
    Route::delete('/{id}', [RecipeController::class, 'delete']);
    Route::post('/{id}/like', [RecipeController::class, 'like'])->name('recipes.like');
    Route::post('/{id}/dislike', [RecipeController::class, 'dislike'])->name('recipes.dislike');
    Route::post('{id}/unlike', [RecipeController::class, 'unlike']);
    Route::post('{id}/undislike', [RecipeController::class, 'undislike']);
    Route::get('/api/recipes/{id}/likes-dislikes', [RecipeController::class, 'getLikesDislikes']);
    Route::post('/{recipeId}/ingredients', [RecipeController::class, 'addIngredientToRecipe']);
    Route::get('/{recipeId}/ingredients', [RecipeController::class, 'getIngredientsByRecipe']);
    Route::delete('/{recipeId}/ingredients/{ingredientId}', [RecipeController::class, 'removeIngredientFromRecipe']);
});

Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index']);
    Route::get('{id}', [CategoryController::class, 'show']);
    Route::get('find/{name}', [CategoryController::class, 'findByName']);
    Route::get('{id}/recipes', [CategoryController::class, 'showRecipesByCategoryId']);
    Route::post('/', [CategoryController::class, 'create']);
    Route::put('{id}', [CategoryController::class, 'update']);
    Route::delete('{id}', [CategoryController::class, 'delete']);
});

Route::prefix('cousines')->group(function () {
    Route::get('/', [CousineController::class, 'index']);
    Route::get('{id}', [CousineController::class, 'show']);
    Route::get('find/{name}', [CousineController::class, 'findByName']);
    Route::get('{id}/recipes', [CousineController::class, 'getRecipesBycousineId']);
    Route::post('/', [CousineController::class, 'create']);
    Route::put('{id}', [CousineController::class, 'update']);
    Route::delete('{id}', [CousineController::class, 'delete']);
});

Route::prefix('instructions')->group(function () {
    Route::get('/', [InstructionController::class, 'index']);
    Route::get('{id}', [InstructionController::class, 'show']);
    Route::post('/', [InstructionController::class, 'create']);
    Route::put('{id}', [InstructionController::class, 'update']);
    Route::delete('{id}', [InstructionController::class, 'delete']);
});

Route::prefix('ingredients')->group(function () {
    Route::get('/', [IngredientController::class, 'index']);
    Route::get('{id}', [IngredientController::class, 'show']);
    Route::post('/', [IngredientController::class, 'create']);
    Route::put('{id}', [IngredientController::class, 'update']);
    Route::delete('{id}', [IngredientController::class, 'delete']);
});

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'create']);
    Route::put('{id}', [UserController::class, 'update']);
    Route::delete('{id}', [UserController::class, 'delete']);
});



