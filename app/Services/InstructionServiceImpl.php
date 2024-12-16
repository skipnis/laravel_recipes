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

}
