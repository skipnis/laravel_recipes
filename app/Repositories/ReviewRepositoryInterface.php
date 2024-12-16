<?php
namespace App\Repositories;

interface ReviewRepositoryInterface extends RepositoryInterface
{
    public function getByRecipeId(int $recipeId);
}
