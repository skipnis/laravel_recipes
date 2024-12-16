<?php

namespace App\Services;

interface UserServiceInterface extends ServiceInterface
{
    public function getUserByEmail(string $email);
}
