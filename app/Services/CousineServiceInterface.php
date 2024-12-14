<?php
// app/Services/CousineServiceInterface.php

namespace App\Services;

interface CousineServiceInterface extends ServiceInterface
{
    public function getRecipesByCousineId($id);
}
