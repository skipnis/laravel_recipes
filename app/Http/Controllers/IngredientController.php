<?php

namespace App\Http\Controllers;

use App\Services\IngredientServiceImpl;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    protected $ingredientService;

    /**
     * Инъекция IngredientServiceImpl в контроллер.
     *
     * @param IngredientServiceImpl $ingredientService
     */
    public function __construct(IngredientServiceImpl $ingredientService)
    {
        $this->ingredientService = $ingredientService;
    }

    /**
     * Получить все ингредиенты.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $ingredients = $this->ingredientService->getAll();
        return response()->json($ingredients);
    }

    /**
     * Получить ингредиент по ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $ingredient = $this->ingredientService->getById($id);
        return response()->json($ingredient);
    }

    /**
     * Создать новый ингредиент.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        // Валидация входных данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Создание ингредиента через сервис
        $ingredient = $this->ingredientService->create($validated);

        return response()->json($ingredient, 201);
    }

    /**
     * Обновить существующий ингредиент.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        // Валидация данных
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        // Обновление ингредиента через сервис
        $ingredient = $this->ingredientService->update($id, $validated);

        return response()->json($ingredient);
    }

    /**
     * Удалить ингредиент.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        // Удаление ингредиента через сервис
        $this->ingredientService->delete($id);

        return response()->json(['message' => 'Ингредиент удален']);
    }
}
