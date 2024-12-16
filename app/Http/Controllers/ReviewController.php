<?php
namespace App\Http\Controllers;

use App\Models\Review;
use App\Services\ReviewServiceInterface;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    protected $reviewService;

    public function __construct(ReviewServiceInterface $reviewService)
    {
        $this->reviewService = $reviewService;
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'comment' => 'required|string|max:1000',
            'recipe_id' => 'required|exists:recipes,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $review = $this->reviewService->addReview([
            'user_id' => $validated['user_id'],
            'recipe_id' => $validated['recipe_id'],
            'comment' => $validated['comment'],
        ]);

        return response()->json($review, 201);
    }


    public function index($recipeId)
    {
        $reviews = $this->reviewService->getReviewsForRecipe($recipeId);
        return response()->json($reviews);
    }
}
