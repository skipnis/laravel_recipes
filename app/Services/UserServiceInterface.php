<?php

namespace App\Services;

interface UserServiceInterface extends ServiceInterface
{
    // Добавьте специфичные методы, например:
    public function getUserByEmail(string $email);
}
