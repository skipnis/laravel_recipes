<?php

namespace App\Repositories;

use App\Models\Favorite;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class FavoriteRepositoryImpl implements FavoriteRepositoryInterface
{
    /**
     * Добавить рецепт в избранное.
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public function addToFavorites(int $userId, int $recipeId): bool
    {
        $existingFavorite = Favorite::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->first();

        if ($existingFavorite) {
            return false;
        }

        Favorite::create([
            'user_id' => $userId,
            'recipe_id' => $recipeId,
        ]);

        return true;
    }

    /**
     * Удалить рецепт из избранного.
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public function removeFromFavorites(int $userId, int $recipeId): bool
    {
        $favorite = Favorite::where('user_id', $userId)
            ->where('recipe_id', $recipeId)
            ->first();

        if (!$favorite) {
            return false;
        }

        $favorite->delete();

        return true;
    }

    /**
     * Получить все избранные рецепты пользователя.
     *
     * @param int $userId
     * @return Collection
     */
    public function getFavoritesByUser(int $userId)
    {
        return Favorite::where('user_id', $userId)
            ->with('recipe')
            ->get();
    }
}
