<?php
// app/Services/CategoryServiceImpl.php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryServiceImpl extends ServiceImpl implements CategoryServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    public function findByName($name)
    {
        return $this->categoryRepository->findByName($name);
    }

    public function getRecipesByCategoryId($id)
    {
        return $this->categoryRepository->getRecipesByCategoryId($id);
    }
}
