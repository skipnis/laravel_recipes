<?php

// app/Repositories/IngredientRepositoryImpl.php

namespace App\Repositories;

use App\Models\Ingredient;

class IngredientRepositoryImpl extends RepositoryImpl implements IngredientRepositoryInterface
{
    public function __construct(Ingredient $model)
    {
        parent::__construct($model);
    }
}
