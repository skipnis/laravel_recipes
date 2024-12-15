<?php

namespace App\Services;

use App\Repositories\FavoriteRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class FavoriteServiceImpl implements FavoriteServiceInterface
{
    protected $favoriteRepository;

    public function __construct(FavoriteRepositoryInterface $favoriteRepository)
    {
        $this->favoriteRepository = $favoriteRepository;
    }

    /**
     * Добавить рецепт в избранное.
     *
     * @param int $userId
     * @param int $recipeId
     * @return bool
     */
    public function addToFavorites(int $userId, int $recipeId): bool
    {
        return $this->favoriteRepository->addToFavorites($userId, $recipeId);
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
        return $this->favoriteRepository->removeFromFavorites($userId, $recipeId);
    }

    /**
     * Получить все избранные рецепты пользователя.
     *
     * @param int $userId
     * @return Collection
     */
    public function getFavoritesByUser(int $userId)
    {
        return $this->favoriteRepository->getFavoritesByUser($userId);
    }
}
