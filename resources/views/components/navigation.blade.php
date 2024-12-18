<!-- resources/views/components/navigation.blade.php -->
<nav class="flex justify-between items-center bg-gray-800 p-4 rounded-lg shadow-lg mb-6">
    <a class="text-xl font-semibold text-white" href="{{ route('recipes.index') }}">RecipeSite</a>
    <div class="space-x-4">
        <a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-orange-500">Home</a>
        <a href="{{ route('recipes.index') }}" class="text-gray-300 hover:text-orange-500">Recipes</a>
        <a href="{{ route('categories.index') }}" class="text-gray-300 hover:text-orange-500">Categories</a>
        <a href="#" class="text-gray-300 hover:text-orange-500">Cousines</a>
        @auth
            <a href="{{ route('profile.show') }}" class="text-gray-300 hover:text-orange-500">Profile</a>
            <a href="{{ route('logout') }}" class="text-gray-300 hover:text-orange-500" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <a href="{{ route('login') }}" class="text-gray-300 hover:text-orange-500">Login</a>
            <a href="{{ route('register') }}" class="text-gray-300 hover:text-orange-500">Register</a>
        @endauth
    </div>
</nav>
