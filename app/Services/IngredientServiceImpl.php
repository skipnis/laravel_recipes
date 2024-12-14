<?php
// app/Services/IngredientServiceImpl.php

namespace App\Services;

use App\Repositories\IngredientRepositoryInterface;

class IngredientServiceImpl extends ServiceImpl implements IngredientServiceInterface
{
    protected $ingredientRepository;

    public function __construct(IngredientRepositoryInterface $ingredientRepository)
    {
        parent::__construct($ingredientRepository);
        $this->ingredientRepository = $ingredientRepository;
    }
}
