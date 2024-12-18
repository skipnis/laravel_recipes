<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $cousine->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
<nav class="bg-gray-800 p-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center text-white">
        <a href="/" class="text-2xl font-bold">RecipeSite</a>
        <ul class="flex space-x-4">
            <li><a href="{{ route('recipes.index') }}" class="hover:text-yellow-500">Рецепты</a></li>
            <li><a href="{{ route('categories.index') }}" class="hover:text-yellow-500">Категории</a></li>
            <li><a href="{{ route('cousines.index') }}" class="hover:text-yellow-500">Кухни</a></li>
        </ul>
    </div>
</nav>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Рецепты кухни: {{ $cousine->name }}</h1>

            @if($recipes->isEmpty())
                <p class="text-gray-500">Рецепты не найдены.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($recipes as $recipe)
                        <div class="bg-gray-100 p-4 rounded-lg shadow hover:shadow-lg transition">
                            <h2 class="text-xl font-medium text-gray-700">{{ $recipe->name }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ Str::limit($recipe->description, 100) }}</p>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500 mt-4 inline-block">Просмотреть рецепт</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
