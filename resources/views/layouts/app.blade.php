<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <x-banner />

        <div class="min-h-screen bg-gray-100">
            <nav class="bg-gray-800 text-white p-4 rounded-lg mb-6">
                <div class="flex justify-between items-center">
                    <a href="{{ route('recipes.index') }}" class="text-2xl font-bold hover:text-yellow-500">RecipeSite</a>
                    <ul class="flex space-x-4">
                        <li><a href="{{ route('recipes.index') }}" class="hover:text-yellow-500">Рецепты</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-yellow-500">Категории</a></li>
                        <li><a class="hover:text-yellow-500">Кухни</a></li>
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

            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts
    </body>
</html>
