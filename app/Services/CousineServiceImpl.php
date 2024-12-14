<?php
// app/Services/CategoryServiceImpl.php

namespace App\Services;

use App\Repositories\CousineRepositoryInterface;

class CousineServiceImpl extends ServiceImpl implements CousineServiceInterface
{
    protected $cousineRepository;

    public function __construct(CousineRepositoryInterface $cousineRepository)
    {
        parent::__construct($cousineRepository);
        $this->cousineRepository = $cousineRepository;
    }

    public function getRecipesByCousineId($id)
    {
        return $this->cousineRepository->getRecipesByCousineId($id);
    }
}
