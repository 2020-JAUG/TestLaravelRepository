<?php

namespace App\Repositories\Interfaces;

use App\Models\User;

interface UserRepositoryInterface extends BaseRepositoryInterface
{
    public function showByName(string $name): User;
    public function showByEmail(string $email): User;
}