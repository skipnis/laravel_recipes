<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface FavoriteRepositoryInterface
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
     * @return Collection
     */
    public function getFavoritesByUser(int $userId);
}
