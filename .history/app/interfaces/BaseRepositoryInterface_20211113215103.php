<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use SebastianBergmann\Type\ObjectType;

interface BaseRepositoryInterface
{
    public function index():Collection;
    public function show(int $id):object;
    public function store(object $model):object;
    public function update(int $id, object $model):object;
    public function delete(int $id):void;
}