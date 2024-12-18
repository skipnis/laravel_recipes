<!-- resources/views/recipes/create.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-900">

<nav class="bg-gray-800 p-4 shadow-lg">
    <div class="max-w-screen-lg mx-auto flex justify-between items-center">
        <a class="text-xl font-semibold text-white hover:text-orange-500 transition-colors" href="{{ route('recipes.index') }}">RecipeSite</a>
        <div class="space-x-4">
            <a href="{{ route('recipes.index') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Рецепты</a>
            <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Категории</a>
            <a href="{{ route('cousines.index') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Кухни</a>
            @auth
                <a href="{{ route('profile.show') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Профиль</a>
                <a href="{{ route('logout') }}" class="text-gray-300 hover:text-orange-500 transition-colors" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Войти</a>
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-orange-500 transition-colors">Регистрация</a>
            @endauth
        </div>
    </div>
</nav>

<div class="container mx-auto mt-10 p-4 max-w-screen-md">
    <h1 class="text-3xl font-semibold text-center text-gray-900 mb-8">Создание нового рецепта</h1>

    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-4">
            <label for="name" class="block text-gray-900">Название рецепта</label>
            <input type="text" name="name" id="name" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" placeholder="Введите название рецепта" value="{{ old('name') }}" required>
            @error('name') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-900">Описание</label>
            <textarea name="description" id="description" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" placeholder="Введите описание рецепта" rows="4">{{ old('description') }}</textarea>
            @error('description') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="category_id" class="block text-gray-900">Категория</label>
            <select name="category_id" id="category_id" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" required>
                <option value="">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="cousine_id" class="block text-gray-900">Кухня</label>
            <select name="cousine_id" id="cousine_id" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" required>
                <option value="">Выберите кухню</option>
                @foreach($cousines as $cousine)
                    <option value="{{ $cousine->id }}" {{ old('cousine_id') == $cousine->id ? 'selected' : '' }}>{{ $cousine->name }}</option>
                @endforeach
            </select>
            @error('cousine_id') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="servings_count" class="block text-gray-900">Порции</label>
            <input type="number" name="servings_count" id="servings_count" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" placeholder="Введите количество порций" value="{{ old('servings_count') }}" required>
            @error('servings_count') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-900">Изображение</label>
            <input type="file" name="image" id="image" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" accept="image/*">
            @error('image') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
        </div>
        <button type="submit" class="w-full py-3 bg-gray-800 text-white rounded-md hover:bg-gray-700 transition-colors">Создать рецепт</button>

        <div class="mb-4">
            <label for="ingredients" class="block text-gray-900">Ингредиенты</label>
            <div id="ingredients-container">
                <!-- Контейнер для динамического добавления ингредиентов -->
                <div class="ingredient-row flex items-center space-x-4 mb-2">
                    <input type="text" name="ingredients[0][name]" placeholder="Название ингредиента" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                    <input type="number" name="ingredients[0][quantity]" placeholder="Количество" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                    <input type="text" name="ingredients[0][unit]" placeholder="Ед. изм. (например, грамм)" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                    <button type="button" class="remove-ingredient text-red-500 hover:text-red-700">&times;</button>
                </div>
            </div>
            <button type="button" id="add-ingredient" class="mt-2 bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition">Добавить ингредиент</button>
        </div>

        <div class="mb-4 invisible">
            <label for="author_id" class="block text-gray-900">Автор</label>
            <input type="number" name="author_id" id="author_id" class="w-full p-3 mt-2 bg-white text-gray-900 border border-gray-600 rounded-md" value="{{ auth()->user()->id }}" readonly>
        </div>

    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let ingredientIndex = 1;

        const addIngredientButton = document.getElementById('add-ingredient');
        const ingredientsContainer = document.getElementById('ingredients-container');

        addIngredientButton.addEventListener('click', () => {
            const newIngredientRow = document.createElement('div');
            newIngredientRow.classList.add('ingredient-row', 'flex', 'items-center', 'space-x-4', 'mb-2');
            newIngredientRow.innerHTML = `
                <input type="text" name="ingredients[${ingredientIndex}][name]" placeholder="Название ингредиента" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                <input type="number" name="ingredients[${ingredientIndex}][quantity]" placeholder="Количество" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                <input type="text" name="ingredients[${ingredientIndex}][unit]" placeholder="Ед. изм. (например, грамм)" class="w-1/3 p-2 border border-gray-600 rounded-md" required>
                <button type="button" class="remove-ingredient text-red-500 hover:text-red-700">&times;</button>
            `;
            ingredientsContainer.appendChild(newIngredientRow);
            ingredientIndex++;
        });

        ingredientsContainer.addEventListener('click', (event) => {
            if (event.target.classList.contains('remove-ingredient')) {
                event.target.parentElement.remove();
            }
        });
    });
</script>

</body>
</html>
