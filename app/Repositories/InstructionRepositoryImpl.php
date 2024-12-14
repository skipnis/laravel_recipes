<?php
// app/Repositories/InstructionRepositoryImpl.php

namespace App\Repositories;

use App\Models\Instruction;

class InstructionRepositoryImpl extends RepositoryImpl implements InstructionRepositoryInterface
{
    public function __construct(Instruction $model)
    {
        parent::__construct($model);
    }

    // Здесь могут быть специфичные методы для работы с инструкциями, если потребуется
}
