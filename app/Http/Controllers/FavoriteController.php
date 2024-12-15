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

    /**
     * Добавить рецепт в избранное.
     *
     * @param Request $request
     * @param int $recipeId
     * @return JsonResponse
     */
    public function addToFavorites(Request $request, $recipeId)
    {
        $userId = auth()->id();

        $result = $this->favoriteService->addToFavorites($userId, $recipeId);

        if ($result) {
            return response()->json(['message' => 'Рецепт добавлен в избранное']);
        }

        return response()->json(['message' => 'Рецепт уже в избранном'], 400);
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
            return response()->json(['message' => 'Рецепт удален из избранного']);
        }

        return response()->json(['message' => 'Рецепт не найден в избранном'], 400);
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
