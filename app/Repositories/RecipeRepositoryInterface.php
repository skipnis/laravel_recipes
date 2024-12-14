<?php
// app/Repositories/RecipeRepositoryInterface.php

namespace App\Repositories;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;

interface RecipeRepositoryInterface extends RepositoryInterface
{
    /**
     * Получить рецепты, фильтруя по категории.
     *
     * @param int $categoryId
     * @return Collection
     */
    public function findByCategory(int $categoryId): Collection;

    /**
     * Получить рецепты, принадлежащие автору.
     *
     * @param int $authorId
     * @return Collection
     */
    public function findByAuthor(int $authorId): Collection;

    /**
     * Получить рецепты по имени.
     *
     * @param string $name
     * @return Recipe
     */
    public function findByName(string $name): Recipe;

    /**
     * Получить все ингредиенты для рецепта с данными из промежуточной таблицы.
     *
     * @param int $recipeId
     * @return Collection
     */
    public function getIngredientsWithDetails(int $recipeId): Collection;
}
