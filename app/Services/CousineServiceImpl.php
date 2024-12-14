<?php
// app/Services/CategoryServiceImpl.php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CousineServiceImpl extends ServiceImpl implements CousineServiceInterface
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        parent::__construct($categoryRepository);
        $this->categoryRepository = $categoryRepository;
    }

    public function getRecipesByCousineId($id)
    {
        return $this->categoryRepository->getRecipesByCategoryId($id);
    }
}
