<?php

// app/Repositories/CategoryRepositoryImpl.php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepositoryImpl extends RepositoryImpl implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function findByName(string $name)
    {
        return $this->model->where('name', $name)->first();
    }

    public function getRecipesByCategoryId($id)
    {
        $category = $this->model->find($id);
        return $category ? $category->recipes : null;
    }
}
