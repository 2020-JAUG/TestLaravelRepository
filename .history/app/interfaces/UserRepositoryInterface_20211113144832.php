<?php

namespace App\Interfaces;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getAllUsers(): array;
    public function getOneUser(int $id): User;
    public function getUserByName(string $name): User;
    public function getUserByEmail(string $email): User;
    public function save(User $user): User;
    public function update(int $id, User $user): User;
    public function delete(int $id): void;
}