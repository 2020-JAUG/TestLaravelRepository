<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use SebastianBergmann\Type\ObjectType;

interface BaseRepositoryInterface
{
    public function index();
    public function show(int $id);
    public function store($model);
    public function update(int $id, $model);
    public function delete(int $id);
}