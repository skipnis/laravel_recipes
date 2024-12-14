<?php
// app/Services/RecipeServiceInterface.php

namespace App\Services;

use App\Models\Recipe;
use Illuminate\Database\Eloquent\Collection;

interface RecipeServiceInterface extends ServiceInterface
{
    public function getByCategory($categoryId);
    public function getByAuthor($authorId);
    public function getByName($name);
    public function getIngredientsWithDetails(int $recipeId): Collection;
}
