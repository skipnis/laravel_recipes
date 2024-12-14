<?php
namespace App\Services;

use App\Repositories\IngredientRecipeRepositoryInterface;

class IngredientRecipeServiceImpl extends ServiceImpl implements IngredientRecipeServiceInterface
{
    protected $repository;

    public function __construct(IngredientRecipeRepositoryInterface $repository)
    {
        parent::__construct($repository);
        $this->repository = $repository;
    }

    public function addIngredientToRecipe(int $recipeId, int $ingredientId, array $data): bool
    {
        return $this->repository->addIngredientToRecipe($recipeId, $ingredientId, $data);
    }

    public function getIngredientsByRecipe(int $recipeId): array
    {
        return $this->repository->getIngredientsByRecipe($recipeId);
    }

    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId): bool
    {
        return $this->repository->removeIngredientFromRecipe($recipeId, $ingredientId);
    }
}
