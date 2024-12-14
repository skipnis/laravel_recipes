<?php
// app/Services/InstructionServiceImpl.php

namespace App\Services;

use App\Repositories\InstructionRepositoryInterface;

class InstructionServiceImpl extends ServiceImpl implements InstructionServiceInterface
{
    protected $instructionRepository;

    public function __construct(InstructionRepositoryInterface $instructionRepository)
    {
        parent::__construct($instructionRepository);
        $this->instructionRepository = $instructionRepository;
    }

    // Здесь мы можем переопределить методы из базового интерфейса ServiceInterface,
    // или добавить дополнительные специфичные методы для инструкций, если нужно.
}
