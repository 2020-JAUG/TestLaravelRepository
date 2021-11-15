<?php

use App\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    /** @var string $model */
    protected string $model;

    /** @var array $with */
    protected array $with = [];

    /** @var array $withCount */
    protected array $withCount = [];

    /** @var array $append */
    protected array $append = [];

    public function index(): Collection
    {
        $model = $this->getModel();
        $builder = $model::query();

        //Aggregating
        $builder->with($this->with);
        $builder->withCount($this->withCount);

        //Instance
        $instance = $builder->all();
        if(!$instance)
        {
            throw new Exception;
        }

        return $instance;
    }

    protected function getModel():Model
    {
        return new $this->model;
    }
}