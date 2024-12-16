<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $recipe->name }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    <!-- Лайк и дизлайк -->
    <div class="likes-dislikes">
        <button id="like-btn" class="btn btn-outline-dark" data-id="{{ $recipe->id }}">
            Лайк
        </button>
        <span id="like-count">({{ $recipe->likes_count }})</span>

        <button id="dislike-btn" class="btn btn-outline-dark" data-id="{{ $recipe->id }}">
            Дизлайк
        </button>
        <span id="dislike-count">({{ $recipe->dislikes_count }})</span>
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
                        // Обновляем только счетчик лайков
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
                        // Обновляем только счетчик дизлайков
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
