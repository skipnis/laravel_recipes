<?php

namespace App\Services;

use App\Repositories\UserRepositoryInterface;

class UserServiceImpl extends ServiceImpl implements UserServiceInterface
{
    protected $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        parent::__construct($repository);
    }

    public function getUserByEmail(string $email)
    {
        return $this->repository->findByEmail($email);
    }
}
