<?php
// app/Services/CategoryServiceInterface.php

namespace App\Services;

interface CategoryServiceInterface extends ServiceInterface
{
    public function findByName($name);
    public function getRecipesByCategoryId($id);
}
