<?php
// app/Repositories/Eloquent/RecipeRepository.php

namespace App\Repositories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Log;

class RecipeRepositoryImpl extends RepositoryImpl implements RecipeRepositoryInterface
{
    public function __construct(Recipe $model)
    {
        parent::__construct($model);
    }

    /**
     * Получить рецепты, фильтруя по категории.
     *
     * @param int $categoryId
     * @return Collection
     */
    public function findByCategory(int $categoryId): Collection
    {
        return $this->model->where('category_id', $categoryId)->get();
    }

    /**
     * Получить рецепты, принадлежащие автору.
     *
     * @param int $authorId
     * @return Collection
     */
    public function findByAuthor(int $authorId): Collection
    {
        return $this->model->where('author_id', $authorId)->get();
    }

    /**
     * Получить рецепт по имени.
     *
     * @param string $name
     * @return Recipe
     */
    public function findByName(string $name): Recipe
    {
        return $this->model->where('name', 'like', "%{$name}%")->first();
    }

    public function getIngredientsWithDetails(int $recipeId): Collection
    {
        $recipe = $this->model->findOrFail($recipeId);
        return $recipe->ingredients()->withPivot('quantity', 'unit')->get();
    }

    public function incrementLikes(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->incrementLikes();
            return true;
        }
        return false;
    }

    public function decrementLikes(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->decrementLikes();
            return true;
        }
        return false;
    }

    public function incrementDislikes(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->incrementDislikes();
            return true;
        }
        return false;
    }

    public function decrementDislikes(int $recipeId)
    {
        $recipe = Recipe::find($recipeId);
        if ($recipe) {
            $recipe->decrementDislikes();
            return true;
        }
        return false;
    }
}
