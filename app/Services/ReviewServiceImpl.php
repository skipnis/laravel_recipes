<?php
namespace App\Services;

use App\Repositories\ReviewRepositoryInterface;
use App\Services\ReviewServiceInterface;

class ReviewServiceImpl extends ServiceImpl implements ReviewServiceInterface
{
    protected $reviewRepository;

    public function __construct(ReviewRepositoryInterface $reviewRepository)
    {
        parent::__construct($reviewRepository);
        $this->reviewRepository = $reviewRepository;
    }

    public function addReview(array $data)
    {
        return $this->reviewRepository->create($data);
    }

    public function getReviewsForRecipe(int $recipeId)
    {
        return $this->reviewRepository->getByRecipeId($recipeId);
    }
}
