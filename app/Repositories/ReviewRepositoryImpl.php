<?php
namespace App\Repositories;

use App\Models\Review;
use App\Repositories\ReviewRepositoryInterface;

class ReviewRepositoryImpl extends RepositoryImpl implements ReviewRepositoryInterface
{
    public function __construct(Review $model)
    {
        parent::__construct($model);
    }
    public function getByRecipeId(int $recipeId)
    {
        return Review::where('recipe_id', $recipeId)->with('user')->get();
    }
}
