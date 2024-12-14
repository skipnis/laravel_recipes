<?php

namespace App\Http\Controllers;

use App\Services\RecipeServiceInterface;
use App\Services\IngredientRecipeServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    protected $recipeService;
    protected $ingredientRecipeService;

    /**
     * Инжектируем оба сервиса в контроллер.
     *
     * @param RecipeServiceInterface $recipeService
     * @param IngredientRecipeServiceInterface $ingredientRecipeService
     */
    public function __construct(RecipeServiceInterface $recipeService, IngredientRecipeServiceInterface $ingredientRecipeService)
    {
        $this->recipeService = $recipeService;
        $this->ingredientRecipeService = $ingredientRecipeService;
    }

    public function index()
    {
        $recipes = $this->recipeService->getAll();
        return response()->json($recipes);
    }

    public function show($id)
    {
        $recipe = $this->recipeService->getById($id);
        return view('recipes.show', compact('recipe'));
    }

    public function findByCategory($categoryId)
    {
        $recipes = $this->recipeService->getByCategory($categoryId);
        return response()->json($recipes);
    }

    public function findByAuthor($authorId)
    {
        $recipes = $this->recipeService->getByAuthor($authorId);
        return response()->json($recipes);
    }

    public function findByName($name)
    {
        $recipe = $this->recipeService->getByName($name);
        return response()->json($recipe);
    }

    /**
     * Создать новый рецепт.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'cousine_id' => 'required|integer',
            'author_id' => 'required|integer',
            'servings_count' => 'required|integer',
        ]);

        // Создаем рецепт через сервис
        $recipe = $this->recipeService->create($validated);

        return response()->json($recipe, 201);
    }

    /**
     * Обновить рецепт.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'cousine_id' => 'required|integer|exists:cousines,id',
            'author_id' => 'required|integer|exists:users,id',
            'servings_count' => 'required|integer',
        ]);

        $recipe = $this->recipeService->update($id, $validated);

        return response()->json($recipe);
    }

    /**
     * Удалить рецепт.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete($id)
    {
        // Удаляем рецепт через сервис
        $this->recipeService->delete($id);

        return response()->json(['message' => 'Рецепт удален']);
    }

    /**
     * Добавить ингредиент к рецепту.
     *
     * @param Request $request
     * @param int $recipeId
     * @return JsonResponse
     */
    public function addIngredientToRecipe(Request $request, int $recipeId)
    {
        $validated = $request->validate([
            'ingredient_id' => 'required|integer|exists:ingredients,id',
            'quantity' => 'nullable|numeric',
            'unit' => 'nullable|string',
        ]);

        $result = $this->ingredientRecipeService->addIngredientToRecipe($recipeId, $validated['ingredient_id'], $validated);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Ингредиент добавлен к рецепту' : 'Ошибка добавления ингредиента',
        ]);
    }

    /**
     * Получить все ингредиенты для рецепта.
     *
     * @param int $recipeId
     * @return JsonResponse
     */
    public function getIngredientsByRecipe(int $recipeId)
    {
        $ingredients = $this->ingredientRecipeService->getIngredientsByRecipe($recipeId);

        return response()->json($ingredients);
    }

    /**
     * Удалить ингредиент из рецепта.
     *
     * @param int $recipeId
     * @param int $ingredientId
     * @return JsonResponse
     */
    public function removeIngredientFromRecipe(int $recipeId, int $ingredientId)
    {
        $result = $this->ingredientRecipeService->removeIngredientFromRecipe($recipeId, $ingredientId);

        return response()->json([
            'success' => $result,
            'message' => $result ? 'Ингредиент удален из рецепта' : 'Ошибка удаления ингредиента',
        ]);
    }

    /**
     * Отображение всех рецептов на странице.
     *
     * @return View
     */
    public function indexView()
    {
        $recipes = $this->recipeService->getAll(); // Получаем все рецепты через сервис

        return view('recipes.index', compact('recipes'));
    }
}
