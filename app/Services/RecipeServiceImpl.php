<?php
// app/Services/RecipeService.php

namespace App\Services;

use App\Repositories\RecipeRepositoryInterface;
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
}
