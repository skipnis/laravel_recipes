<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cousine;
use App\Services\CategoryServiceInterface;
use App\Services\CousineServiceInterface;
use App\Services\RecipeServiceInterface;
use App\Services\IngredientRecipeServiceInterface;
use App\Services\ReviewServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RecipeController extends Controller
{
    protected $recipeService;
    protected $ingredientRecipeService;
    protected $reviewService;
    protected $cousineService;
    protected $categoryService;

    /**
     * Инжектируем все необходимые сервисы в контроллер.
     *
     * @param RecipeServiceInterface $recipeService
     * @param IngredientRecipeServiceInterface $ingredientRecipeService
     * @param ReviewServiceInterface $reviewService
     * @param CousineServiceInterface $cousineService
     * @param CategoryServiceInterface $categoryService
     */
    public function __construct(
        RecipeServiceInterface $recipeService,
        IngredientRecipeServiceInterface $ingredientRecipeService,
        ReviewServiceInterface $reviewService,
        CousineServiceInterface $cousineService,
        CategoryServiceInterface $categoryService
    ) {
        $this->recipeService = $recipeService;
        $this->ingredientRecipeService = $ingredientRecipeService;
        $this->reviewService = $reviewService;
        $this->cousineService = $cousineService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $recipes = $this->recipeService->getAll();
        return response()->json($recipes);
    }

    public function show($id)
    {
        $recipe = $this->recipeService->getById($id);
        $reviews = $this->reviewService->getReviewsForRecipe($id);
        return view('recipes.show', compact('recipe', 'reviews'));
    }

    public function showCreateForm()
    {
        $categories = $this->categoryService->getAll(); // Предположим, что у вас есть модель Category
        $cousines = $this->cousineService->getAll(); // Предположим, что у вас есть модель Cuisine
        return view('recipes.create', compact('categories', 'cousines'));
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

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|integer',
            'cousine_id' => 'required|integer',
            'author_id' => 'required|integer',
            'servings_count' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->file('image')->getClientOriginalExtension();

            $request->file('image')->move(public_path('images/recipes'), $imageName);

            $imagePath = 'images/recipes/' . $imageName;
        }

        $validated['image'] = $imagePath ? basename($imagePath) : null;

        $this->recipeService->create($validated);

        return redirect()->route('recipes.index');
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
            'likes_count' => 'nullable|integer|min:0',
            'dislikes_count' => 'nullable|integer|min:0'
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
        $recipes = $this->recipeService->getAll();

        return view('recipes.index', compact('recipes'));
    }
    public function like($id)
    {
        $success = $this->recipeService->likeRecipe($id);
        $recipe = $this->recipeService->getById($id);
        return response()->json([
            'success' => $success,
            'likes_count' => $recipe->likes_count,
            'dislikes_count' => $recipe->dislikes_count,
            'message' => $success ? 'Вам понравился рецепт' : 'Ошибка лайка',
        ]);
    }
    public function dislike($id)
    {
        $success = $this->recipeService->dislikeRecipe($id);
        $recipe = $this->recipeService->getById($id);
        return response()->json([
            'success' => $success,
            'likes_count' => $recipe->likes_count,
            'dislikes_count' => $recipe->dislikes_count,
            'message' => $success ? 'Рецепт дизлайкнут' : 'Ошибка дизлайка',
        ]);
    }
    public function unlike($id)
    {
        $success = $this->recipeService->unlikeRecipe($id);
        $recipe = $this->recipeService->getById($id);
        return response()->json([
            'success' => $success,
            'likes_count' => $recipe->likes_count,
            'dislikes_count' => $recipe->dislikes_count,
            'message' => $success ? 'Лайк отменён' : 'Ошибка отмены лайка',
        ]);
    }
    public function undislike($id)
    {
        $success = $this->recipeService->undislikeRecipe($id);
        $recipe = $this->recipeService->getById($id);
        return response()->json([
            'success' => $success,
            'likes_count' => $recipe->likes_count,
            'dislikes_count' => $recipe->dislikes_count,
            'message' => $success ? 'Дизлайк отменён' : 'Ошибка отмены дизлайка',
        ]);
    }

    public function getLikesDislikes($id)
    {
        $recipe = $this->recipeService->getById($id);

        return response()->json([
            'likes_count' => $recipe->likes_count,
            'dislikes_count' => $recipe->dislikes_count,
        ]);
    }

}
