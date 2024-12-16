<?php
// app/Services/RecipeService.php

namespace App\Services;

use App\Repositories\RecipeRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\Recipe;

class RecipeServiceImpl extends ServiceImpl implements RecipeServiceInterface
{
    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        parent::__construct($recipeRepository);
    }

    public function getByCategory($categoryId)
    {
        return $this->repository->findByCategory($categoryId);
    }

    public function getByAuthor($authorId)
    {
        return $this->repository->findByAuthor($authorId);
    }

    public function getByName($name)
    {
        return $this->repository->findByName($name);
    }

    public function getIngredientsWithDetails(int $recipeId): Collection
    {
        return $this->repository->getIngredientsWithDetails($recipeId);
    }

    public function likeRecipe(int $recipeId): bool
    {
        return $this->repository->incrementLikes($recipeId);
    }

    public function dislikeRecipe(int $recipeId)
    {
        return $this->repository->incrementDislikes($recipeId);
    }
    public function unlikeRecipe(int $recipeId)
    {
        return $this->repository->decrementLikes($recipeId);
    }

    public function undislikeRecipe(int $recipeId)
    {
        return $this->repository->decrementDislikes($recipeId);
    }
}
