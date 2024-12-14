<?php
namespace App\Services;

use App\Repositories\IngredientRecipeRepositoryInterface;

class IngredientRecipeServiceImpl implements IngredientRecipeServiceInterface
{
    protected $ingredientRecipeRepository;

    /**
     * Создаем сервис с внедрением зависимости репозитория.
     *
     * @param IngredientRecipeRepositoryInterface $ingredientRecipeRepository
     */
    public function __construct(IngredientRecipeRepositoryInterface $ingredientRecipeRepository)
    {
        $this->ingredientRecipeRepository = $ingredientRecipeRepository;
    }

    /**
     * Добавить ингредиент к рецепту.
     *
     * @param int $recipeId
     * @param int $ingredientId
     * @param array $data
     * @return bool
     */
    public function addIngredientToRecipe(int $recipeId, int $ingredientId, array $data): bool
    {
        return $this->ingredientRecipeRepository->addIngredientToRecipe($recipeId, $ingredientId, $data);
    }

    /**
     * Получить ингредиенты для рецепта.
     *
     * @param int $recipeId
     * @return array
     */
    public function getIngredientsByRecipe(int $recipeId): array
    {
        return $this->ingredientRecipeRepository->getIngredientsByRecipe($recipeId);
    }

    /**
     * Удалить ингредиент из рецепта.
     *
     * @param int $recipeId
     * @param int $ingredientId
     * @return bool
     */
    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId): bool
    {
        return $this->ingredientRecipeRepository->removeIngredientFromRecipe($recipeId, $ingredientId);
    }
}
