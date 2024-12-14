<?php
// app/Repositories/Eloquent/RecipeRepository.php

namespace App\Repositories;

use App\Models\Recipe;
use App\Repositories\RecipeRepositoryInterface;
use App\Repositories\RepositoryImpl;
use Illuminate\Database\Eloquent\Collection;

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
}
