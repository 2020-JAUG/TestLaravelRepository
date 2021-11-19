<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface AuthRepositoryInterface
{
    public function login(Request $attributes): array;

    public function register(Request $attributes): array;

    public function refresh(string $token): string;
}