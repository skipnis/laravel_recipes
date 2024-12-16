<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все рецепты</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
<div class="max-w-screen-lg mx-auto px-4 py-6">
    <nav class="flex justify-between items-center bg-gray-800 p-4 rounded-lg shadow-lg mb-6">
        <a class="text-xl font-semibold text-white" href="{{ route('recipes.index') }}">RecipeSite</a>
        <div class="space-x-4">
            <a href="{{ route('recipes.index') }}" class="text-gray-300 hover:text-orange-500">Рецепты</a>
            <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-orange-500">Категории</a>
            <a href="#" class="text-gray-300 hover:text-orange-500">Кухни</a>
            @auth
                <a href="{{ route('profile.show') }}" class="text-gray-300 hover:text-orange-500">Профиль</a>
                <a href="{{ route('logout') }}" class="text-gray-300 hover:text-orange-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}" class="text-gray-300 hover:text-orange-500">Войти</a>
                <a href="{{ route('register') }}" class="text-gray-300 hover:text-orange-500">Регистрация</a>
            @endauth
        </div>
    </nav>

    <!-- Флеш-сообщение -->
    @if(session('success'))
        <div id="flash-message" class="fixed bottom-4 left-1/2 transform -translate-x-1/2 bg-green-500 text-white px-4 py-2 rounded-md shadow-md z-50">
            {{ session('success') }}
        </div>
    @endif

    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-8">Рецепты</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($recipes as $recipe)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->name }}" class="w-full h-56 object-cover">
                <div class="p-4">
                    <h5 class="text-xl font-semibold text-gray-800">{{ $recipe->name }}</h5>
                    <p class="text-gray-600 mt-2">{{ Str::limit($recipe->description, 100) }}</p>
                    <a href="{{ route('recipes.show', $recipe->id) }}" class="text-blue-500 hover:underline mt-3 inline-block">Посмотреть</a>

                    <div class="mt-4">
                        @auth
                            @if(auth()->user()->favorites && auth()->user()->favorites->contains($recipe->id))
                                <!-- Кнопка удаления из избранных -->
                                <form action="{{ route('favorites.remove', $recipe->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Удалить из избранного</button>
                                </form>
                            @else
                                <!-- Кнопка добавления в избранное -->
                                <form action="{{ route('favorites.add', $recipe->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-md hover:bg-yellow-600">Добавить в избранное</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessage = document.getElementById('flash-message');
        if (flashMessage) {
            setTimeout(() => {
                flashMessage.style.opacity = '0';
                setTimeout(() => flashMessage.remove(), 500);
            }, 3000);
        }
    });
</script>
</body>
</html>
