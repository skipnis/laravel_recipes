<?php
namespace App\Services;

interface ReviewServiceInterface extends ServiceInterface
{
    public function addReview(array $data);
    public function getReviewsForRecipe(int $recipeId);
}
