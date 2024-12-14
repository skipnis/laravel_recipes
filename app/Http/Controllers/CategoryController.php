<?php

namespace App\Http\Controllers;

use App\Services\CategoryServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Получить все категории.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $categories = $this->categoryService->getAll();
        return response()->json($categories);
    }

    /**
     * Получить категорию по ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $category = $this->categoryService->getById($id);
        return response()->json($category);
    }

    /**
     * Найти категорию по имени.
     *
     * @param string $name
     * @return JsonResponse
     */
    public function findByName(string $name): JsonResponse
    {
        $category = $this->categoryService->findByName($name);
        return response()->json($category);
    }

    /**
     * Получить рецепты по ID категории.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getRecipesByCategoryId(int $id): JsonResponse
    {
        $recipes = $this->categoryService->getRecipesByCategoryId($id);
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

        $category = $this->categoryService->create($validated);
        return response()->json($category, 201);
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

        $category = $this->categoryService->update($id, $validated);
        return response()->json($category);
    }

    /**
     * Удалить категорию.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->categoryService->delete($id);
        return response()->json(['message' => 'Категория удалена']);
    }
}
