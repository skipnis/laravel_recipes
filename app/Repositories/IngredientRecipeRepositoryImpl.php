<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class IngredientRecipeRepositoryImpl implements IngredientRecipeRepositoryInterface
{
    protected $table = 'ingredient_recipe';

    /**
     * Добавить ингредиент к рецепту.
     *
     * @param int $recipeId
     * @param int $ingredientId
     * @param array $data
     * @return bool
     */
    public function addIngredientToRecipe(int $recipeId, int $ingredientId, array $data): bool
    {
        return DB::table($this->table)->insert([
            'recipe_id' => $recipeId,
            'ingredient_id' => $ingredientId,
            'quantity' => $data['quantity'] ?? null,
            'unit' => $data['unit'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Получить ингредиенты для рецепта.
     *
     * @param int $recipeId
     * @return array
     */
    public function getIngredientsByRecipe(int $recipeId): array
    {
        return DB::table($this->table)
            ->where('recipe_id', $recipeId)
            ->get()
            ->toArray();
    }

    /**
     * Удалить ингредиент из рецепта.
     *
     * @param int $recipeId
     * @param int $ingredientId
     * @return bool
     */
    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId): bool
    {
        return DB::table($this->table)
            ->where('recipe_id', $recipeId)
            ->where('ingredient_id', $ingredientId)
            ->delete();
    }
}
