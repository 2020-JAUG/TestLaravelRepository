<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\ObjectType;

interface BaseRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function store(Model $model);
    public function update(int $id, Model $model);
    public function delete(int $id);
}