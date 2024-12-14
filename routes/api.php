<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


use App\Http\Controllers\RecipeController;

// Все маршруты для рецептов
Route::prefix('/recipes')->group(function () {
    Route::get('/', [RecipeController::class, 'index']); // Получить все рецепты
    Route::get('/{id}', [RecipeController::class, 'show']); // Получить рецепт по ID
    Route::get('/category/{categoryId}', [RecipeController::class, 'findByCategory']); // Поиск по категории
    Route::get('/author/{authorId}', [RecipeController::class, 'findByAuthor']); // Поиск по автору
    Route::get('/name/{name}', [RecipeController::class, 'findByName']); // Поиск по имени
    Route::post('/', [RecipeController::class, 'create']); // Создать рецепт
    Route::put('/{id}', [RecipeController::class, 'update']); // Обновить рецепт
    Route::delete('/{id}', [RecipeController::class, 'delete']); // Удалить рецепт
});
