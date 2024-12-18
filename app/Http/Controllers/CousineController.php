<?php

namespace App\Http\Controllers;

use App\Services\CousineServiceInterface;
use App\Services\RecipeServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CousineController extends Controller
{
    protected $cousineService;
    protected $recipeService;

    public function __construct(CousineServiceInterface $cousineService, RecipeServiceInterface $recipeService)
    {
        $this->cousineService = $cousineService;
        $this->recipeService = $recipeService;
    }

    public function index()
    {
        $cousines = $this->cousineService->getAll();
        return view('cousines.index', compact('cousines'));
    }


    public function show(int $id)
    {
        $cousine = $this->cousineService->getById($id); // Получаем информацию о кухне
        $recipes = $this->cousineService->getRecipesByCousineId($id); // Получаем рецепты для кухни
        return view('recipes.index', compact('recipes'));
    }

    /**
     * Получить рецепты по ID категории.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getRecipesBycousineId(int $id): JsonResponse
    {
        $recipes = $this->cousineService->getRecipesBycousineId($id);
        return response()->json($recipes);
    }

    /**
     * Создать новую категорию.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cousine = $this->cousineService->create($validated);
        return response()->json($cousine, 201);
    }

    /**
     * Обновить категорию.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $cousine = $this->cousineService->update($id, $validated);
        return response()->json($cousine);
    }

    /**
     * Удалить категорию.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->cousineService->delete($id);
        return response()->json(['message' => 'Категория удалена']);
    }
}
