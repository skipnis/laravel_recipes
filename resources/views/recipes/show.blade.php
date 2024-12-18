<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->name }}</title>
    <!-- Подключение стилей Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-50">

<div class="container mx-auto px-4 py-8">
    <!-- Навигация -->
    <nav class="bg-gray-800 text-white p-4 rounded-lg mb-6">
        <div class="flex justify-between items-center">
            <a href="{{ route('recipes.index') }}" class="text-2xl font-bold hover:text-yellow-500">RecipeSite</a>
            <ul class="flex space-x-4">
                <li><a href="{{ route('recipes.index') }}" class="hover:text-yellow-500">Рецепты</a></li>
                <li><a href="{{ route('categories.index') }}" class="hover:text-yellow-500">Категории</a></li>
                <li><a href="{{ route('cousines.index') }}" class="hover:text-yellow-500">Кухни</a></li>
                @auth
                    <li><a href="{{ route('profile.show') }}" class="hover:text-yellow-500">Профиль</a></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="hover:text-yellow-500">Logout</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <li><a href="{{ route('login') }}" class="hover:text-yellow-500">Войти</a></li>
                    <li><a href="{{ route('register') }}" class="hover:text-yellow-500">Выйти</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Рецепт -->
    <div class="bg-white p-6 rounded-lg shadow-lg">
        <img src="{{ asset('/images/recipes/' . $recipe->image) }}" class="w-full h-64 object-cover rounded-lg mb-6" alt="{{ $recipe->name }}">

        <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $recipe->name }}</h1>
        <p class="text-gray-600 mb-4">{{ $recipe->description }}</p>
        <p><strong>Категория:</strong> {{ $recipe->category->name }}</p>
        <p><strong>Кухня:</strong> {{ $recipe->cousine->name }}</p>
        <p><strong>Автор:</strong> {{ $recipe->author->name }}</p>
        <p><strong>Количество порций:</strong> {{ $recipe->servings_count }}</p>

        <h3 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Ингредиенты</h3>
        <ul class="list-disc pl-6 mb-6">
            @foreach ($recipe->ingredients as $ingredient)
                <li>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</li>
            @endforeach
        </ul>

        <h3 class="text-xl font-semibold text-gray-700 mt-6 mb-3">Инструкции</h3>
        <ol class="list-decimal pl-6">
            @foreach ($recipe->instructions as $instruction)
                <li>{{ $instruction->description }}</li>
            @endforeach
        </ol>
    </div>

    <hr class="my-8">

    <!-- Лайк и дизлайк -->
    <div class="flex space-x-4 mb-8">
        <button id="like-btn" class="bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-yellow-500 transition" data-id="{{ $recipe->id }}">
            Лайк
        </button>
        <span id="like-count">({{ $recipe->likes_count }})</span>

        <button id="dislike-btn" class="bg-gray-800 text-white py-2 px-4 rounded-lg hover:bg-yellow-500 transition" data-id="{{ $recipe->id }}">
            Дизлайк
        </button>
        <span id="dislike-count">({{ $recipe->dislikes_count }})</span>
    </div>

    <hr class="my-8">

    <!-- Отзывы -->
    <h3 class="text-2xl font-semibold text-gray-800 mb-4">Отзывы:</h3>
    @if($reviews->isEmpty())
        <p class="text-gray-500">Отзывов пока нет.</p>
    @else
        @foreach ($reviews as $review)
            <div class="bg-gray-100 p-4 rounded-lg shadow mb-4">
                <p><strong>{{ $review->user->name }}:</strong></p>
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    @endif

    <hr class="my-8">

    <!-- Форма для отзыва -->
    @auth
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

            <div class="mb-4">
                <label for="comment" class="block text-lg font-medium text-gray-700">Ваш отзыв</label>
                <textarea name="comment" id="comment" class="w-full p-3 mt-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" rows="4" required></textarea>
            </div>

            <button type="submit" class="bg-yellow-500 text-white py-2 px-6 rounded-lg hover:bg-yellow-600 transition">Оставить отзыв</button>
        </form>
    @else
        <p class="text-gray-500">Чтобы оставить отзыв, необходимо <a href="{{ route('login') }}" class="text-blue-500">войти</a>.</p>
    @endauth
</div>

<script>
    $(document).ready(function() {
        // Лайк
        $('#like-btn').click(function() {
            let recipeId = $(this).data('id');
            $.ajax({
                url: '/api/recipes/' + recipeId + '/like',
                method: 'POST',
                success: function(response) {
                    if (response.success) {
                        $('#like-count').text('(' + response.likes_count + ')');
                        $('#dislike-count').text('(' + response.dislikes_count + ')');
                    }
                    alert(response.message);
                }
            });
        });

        // Дизлайк
        $('#dislike-btn').click(function() {
            let recipeId = $(this).data('id');
            $.ajax({
                url: '/api/recipes/' + recipeId + '/dislike',
                method: 'POST',
                success: function(response) {
                    if (response.success) {
                        $('#dislike-count').text('(' + response.dislikes_count + ')');
                        $('#like-count').text('(' + response.likes_count + ')');
                    }
                    alert(response.message);
                }
            });
        });
    });
</script>

</body>
</html>
