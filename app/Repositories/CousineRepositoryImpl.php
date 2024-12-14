<?php
// app/Repositories/CousineRepositoryImpl.php

namespace App\Repositories;

use App\Models\Cousine;

class CousineRepositoryImpl extends RepositoryImpl implements CousineRepositoryInterface
{
    public function __construct(Cousine $model)
    {
        parent::__construct($model);
    }

    public function getRecipesByCousineId($id){
        $cousine = $this->find($id);
        return $cousine ? $cousine ->recipes : null;
    }
}

