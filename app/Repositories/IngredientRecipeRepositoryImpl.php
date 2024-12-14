<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class IngredientRecipeRepositoryImpl extends RepositoryImpl  implements IngredientRecipeRepositoryInterface
{
    protected $table = 'ingredient_recipe';

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

    public function getIngredientsByRecipe(int $recipeId): array
    {
        return DB::table($this->table)
            ->where('recipe_id', $recipeId)
            ->get()
            ->toArray();
    }

    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId): bool
    {
        return DB::table($this->table)
            ->where('recipe_id', $recipeId)
            ->where('ingredient_id', $ingredientId)
            ->delete();
    }
}
