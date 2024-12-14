<?php

namespace App\Http\Controllers;

use App\Services\cousineServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CousineController extends Controller
{
    protected $cousineService;

    public function __construct(CousineServiceInterface $cousineService)
    {
        $this->$cousineService = $cousineService;
    }

    /**
     * Получить все категории.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $cousines = $this->cousineService->getAll();
        return response()->json($cousines);
    }

    /**
     * Получить категорию по ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $cousine = $this->cousineService->getById($id);
        return response()->json($cousine);
    }

    /**
     * Найти категорию по имени.
     *
     * @param string $name
     * @return JsonResponse
     */
    public function findByName(string $name): JsonResponse
    {
        $cousine = $this->cousineService->findByName($name);
        return response()->json($cousine);
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
