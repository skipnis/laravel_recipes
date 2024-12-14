<?php
namespace App\Repositories;

interface IngredientRecipeRepositoryInterface
{
    public function addIngredientToRecipe(int $recipeId, int $ingredientId, array $data): bool;

    public function getIngredientsByRecipe(int $recipeId): array;

    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId): bool;
}
