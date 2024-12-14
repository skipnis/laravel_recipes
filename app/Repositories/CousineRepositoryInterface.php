<?php

// app/Repositories/CousineRepositoryInterface.php

namespace App\Repositories;

interface CousineRepositoryInterface extends RepositoryInterface
{
    public function getRecipesByCousineId($id);
}
