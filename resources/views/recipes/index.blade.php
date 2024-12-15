<!-- resources/views/recipes/index.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Все рецепты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="text-center mb-4">Рецепты</h1>
    <div class="row">
        @foreach ($recipes as $recipe)
            <div class="col-md-4">
                <div class="card mb-4">
                    <img src="{{ asset('images/recipes/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $recipe->name }}</h5>
                        <p class="card-text">{{ Str::limit($recipe->description, 100) }}</p>
                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary">Посмотреть</a>

                        <!-- Проверяем, добавлен ли рецепт в избранное -->
                        @if(auth()->check() && auth()->user()->favorites && auth()->user()->favorites->contains($recipe->id))
                            <!-- Кнопка удаления из избранных -->
                            <form action="{{ route('favorites.remove', $recipe->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить из избранного</button>
                            </form>
                        @else
                            <!-- Кнопка добавления в избранное -->
                            <form action="{{ route('favorites.add', $recipe->id) }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">Добавить в избранное</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
</body>
</html>