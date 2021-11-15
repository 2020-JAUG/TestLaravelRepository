<?php

use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    /** @var string $model */
    protected string $model;

    /** @var array $with */
    protected array $with = [];

    /** @var array $withCount */
    protected array $withCount = [];

    /** @var array $append */
    protected array $append = [];

    protected function getModel():Model
    {
        return new $this->model;
    }
}