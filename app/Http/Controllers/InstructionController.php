<?php

namespace App\Http\Controllers;

use App\Services\InstructionServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class InstructionController extends Controller
{
    protected $instructionService;

    public function __construct(InstructionServiceInterface $instructionService)
    {
        $this->instructionService = $instructionService;
    }

    /**
     * Получить все инструкции.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $instructions = $this->instructionService->getAll();
        return response()->json($instructions);
    }

    /**
     * Получить инструкцию по ID.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $instruction = $this->instructionService->getById($id);
        return response()->json($instruction);
    }

    /**
     * Создать новую инструкцию.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'recipe_id' => 'required|integer|exists:recipes,id',
            'time' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $instruction = $this->instructionService->create($validated);
        return response()->json($instruction, 201);
    }

    /**
     * Обновить инструкцию.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $validated = $request->validate([
            'recipe_id' => 'required|integer|exists:recipes,id',
            'time' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        $instruction = $this->instructionService->update($id, $validated);
        return response()->json($instruction);
    }

    /**
     * Удалить инструкцию.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(int $id): JsonResponse
    {
        $this->instructionService->delete($id);
        return response()->json(['message' => 'Инструкция удалена']);
    }
}
