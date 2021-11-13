<?php

namespace App\Interfaces;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserRepositoryInterface
{
    public function getAllUsers(): Collection;
    public function getOneUser(int $id): User|null;
    public function getUserByName(string $name): User;
    public function getUserByEmail(string $email): User|null;
    public function save(User $user): User|null;
    public function update(int $id, User $user): User|null;
    public function delete(int $id): ?string;
}