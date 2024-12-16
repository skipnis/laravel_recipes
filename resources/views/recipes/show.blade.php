<!-- resources/views/recipes/show.blade.php -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="card">
        <img src="{{ asset('/images/recipes/' . $recipe->image) }}" class="card-img-top" alt="{{ $recipe->name }}">
        <div class="card-body">
            <h1 class="card-title">{{ $recipe->name }}</h1>
            <p class="card-text">{{ $recipe->description }}</p>
            <p><strong>Категория:</strong> {{ $recipe->category->name }}</p>
            <p><strong>Кухня:</strong> {{ $recipe->cousine->name }}</p>
            <p><strong>Автор:</strong> {{ $recipe->author->name }}</p>
            <p><strong>Количество порций:</strong> {{ $recipe->servings_count }}</p>

            <h3>Ингредиенты</h3>
            <ul>
                @foreach ($recipe->ingredients as $ingredient)
                    <li>{{ $ingredient->name }} - {{ $ingredient->pivot->quantity }} {{ $ingredient->pivot->unit }}</li>
                @endforeach
            </ul>

            <h3>Инструкции</h3>
            <ol>
                @foreach ($recipe->instructions as $instruction)
                    <li>{{ $instruction->description }}</li>
                @endforeach
            </ol>
        </div>
    </div>
    <hr>
    <!-- Отзывы -->
    <h3>Отзывы:</h3>
    @if($reviews->isEmpty())
        <p>Отзывов пока нет.</p>
    @else
        @foreach ($reviews as $review)
            <div class="review">
                <p><strong>{{ $review->user->name }}:</strong></p>
                <p>{{ $review->comment }}</p>
            </div>
        @endforeach
    @endif
    <hr>
    <!-- Форма для отзыва -->
    @auth
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="recipe_id" value="{{ $recipe->id }}">

            <div class="mb-3">
                <label for="comment" class="form-label">Ваш отзыв</label>
                <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Оставить отзыв</button>
        </form>
    @else
        <p>Чтобы оставить отзыв, необходимо <a href="{{ route('login') }}">войти</a>.</p>
    @endauth
</div>

</body>
</html>
