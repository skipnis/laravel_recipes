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

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return view('categories.index', compact('categories'));
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

    public function getRecipesByCategoryId(int $id)
    {
        $recipes = $this->categoryService->getRecipesByCategoryId($id);
        $category = $this->categoryService->getById($id);
        if (!$recipes) {
            return redirect()->route('categories.index')->with('error', 'Рецепты не найдены в этой категории');
        }
        return view('recipes.index', compact('category', 'recipes'));
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
