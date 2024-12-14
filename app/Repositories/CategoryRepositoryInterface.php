<?php

namespace App\Repositories;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function findByName(string $name);
    public function getRecipesByCategoryId($id);
}
