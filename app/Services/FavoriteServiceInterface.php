<?php

namespace App\Services;

interface FavoriteServiceInterface
{
    /**
     * Добавить рецепт в избранное.
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public function addToFavorites(int $userId, int $recipeId): bool;

    /**
     * Удалить рецепт из избранного.
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public function removeFromFavorites(int $userId, int $recipeId): bool;

    /**
     * Получить все избранные рецепты пользователя.
     *
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getFavoritesByUser(int $userId);
}
