<?php

namespace App\Http\Controllers;

use App\Services\FavoriteServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    protected $favoriteService;

    public function __construct(FavoriteServiceInterface $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    public function addToFavorites(Request $request, $recipeId)
    {
        $userId = auth()->id();

        $result = $this->favoriteService->addToFavorites($userId, $recipeId);

        if ($result) {
            session()->flash('success', 'Рецепт успешно добавлен в избранное!');
        }
        else {
            session()->flash('success', 'Рецепт уже в избранном!');
        }

        return redirect()->back();
    }

    /**
     * Удалить рецепт из избранного.
     *
     * @param Request $request
     * @param int $recipeId
     * @return JsonResponse
     */
    public function removeFromFavorites(Request $request, $recipeId)
    {
        $userId = auth()->id();

        $result = $this->favoriteService->removeFromFavorites($userId, $recipeId);

        if ($result) {
            session()->flash('success', 'Рецепт успешно удален!');
        }
        else
        {
            session()->flash('success', 'Рецепт уже удален!');
        }
        return redirect()->back();
    }

    /**
     * Получить все избранные рецепты пользователя.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getFavorites(Request $request)
    {
        $userId = auth()->id(); // Получаем текущего пользователя

        $favorites = $this->favoriteService->getFavoritesByUser($userId);

        return response()->json($favorites);
    }
}
