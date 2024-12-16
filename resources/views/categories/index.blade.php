<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Категории рецептов</title>
    <!-- Подключение стилей Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">Категории рецептов</h1>

            @if($categories->isEmpty())
                <p class="text-gray-500">Категории не найдены.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                    @foreach($categories as $category)
                        <div class="bg-gray-100 p-4 rounded-lg shadow hover:shadow-lg transition">
                            <h2 class="text-xl font-medium text-gray-700">{{ $category->name }}</h2>
                            <p class="mt-2 text-sm text-gray-500">{{ Str::limit($category->description, 100) }}</p>
                            <a href="{{ route('categories.show', $category->id) }}" class="text-blue-500 mt-4 inline-block">Просмотреть рецепты</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
