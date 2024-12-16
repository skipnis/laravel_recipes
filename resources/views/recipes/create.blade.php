<!-- resources/views/recipes/create.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Recipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Create a New Recipe</h1>

    <!-- Форма для создания рецепта -->
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Поле для названия рецепта -->
        <div class="mb-3">
            <label for="name" class="form-label">Recipe Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="Enter recipe name" value="{{ old('name') }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для описания рецепта -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter recipe description" rows="4">{{ old('description') }}</textarea>
            @error('description') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для выбора категории -->
        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-select" required>
                <option value="">Select a category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для выбора кухни -->
        <div class="mb-3">
            <label for="cousine_id" class="form-label">Cuisine</label>
            <select name="cousine_id" id="cousine_id" class="form-select" required>
                <option value="">Select a cuisine</option>
                @foreach($cousines as $cousine)
                    <option value="{{ $cousine->id }}" {{ old('cousine_id') == $cousine->id ? 'selected' : '' }}>{{ $cousine->name }}</option>
                @endforeach
            </select>
            @error('cousine_id') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для количества порций -->
        <div class="mb-3">
            <label for="servings_count" class="form-label">Servings</label>
            <input type="number" name="servings_count" id="servings_count" class="form-control" placeholder="Enter servings count" value="{{ old('servings_count') }}" required>
            @error('servings_count') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для изображения рецепта -->
        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" name="image" id="image" class="form-control" accept="image/*">
            @error('image') <div class="text-danger">{{ $message }}</div> @enderror
        </div>

        <!-- Поле для авторизации (автоматически устанавливается) -->
        <div class="mb-3">
            <label for="author_id" class="form-label">Author</label>
            <input type="number" name="author_id" id="author_id" class="form-control" value="{{ auth()->user()->id }}" readonly>
        </div>

        <button type="submit" class="btn btn-primary">Create Recipe</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
