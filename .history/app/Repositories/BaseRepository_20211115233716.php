<?php

namespace App\Repositories;

use App\Interfaces\BaseRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

abstract class BaseRepository implements BaseRepositoryInterface
{
    /** @var string $model */
    protected string $model;

    /** @var array $with */
    protected array $with = [];

    /** @var array $withCount */
    protected array $withCount = [];

    /** @var array $append */
    protected array $append = [];

    /** @var string $notFoundException */
    protected string $notFoundException;

    public function index(): Collection
    {
        $model = $this->getModel();
        $builder = $model::query();

        //Aggregating
        $builder->with($this->with);
        $builder->withCount($this->withCount);

        //Instance
        $results = $builder->get();
        if(!$results)
        {
            throw new Exception();
        }

        return $results;
    }

    public function show(int $id):Model
    {
        $model = $this->getModel();
        $builder = $model::query();

        //Aggregating
        $builder->with($this->with);
        $builder->withCount($this->withCount);

        //Instance
        try{
            $instance = $builder->findOrFail($id);
        }catch(Exception $ex){
            throw new $this->notFoundException();
        }

        return $instance;
    }

    public function store(array $attributes = []):Model
    {
        $model = $this->getModel();
        $builder = $model::query();
        DB::beginTransaction();

        try{
            $instance = $builder->create($attributes);
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
        $instance->load($this->with);
        $instance->loadCount($this->withCount);
        return $instance;
    }

    public function update(int $id, array $attributes = []):Model
    {
        $instance = $this->show($id);

        DB::beginTransaction();

        try{
            $instance->update($attributes);
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }

        return $instance;
    }

    public function delete(int $id):void
    {
        $instance = $this->show($id);
        DB::beginTransaction();

        try{
            $instance->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
    }

    protected function getModel():Model
    {
        return new $this->model;
    }

    protected function appendKey(Model $model, string $key)
    {
        if( strpos($key, '.') !== false)
        {
            $segments = explode('.', $key);
            $appendKey = array_pop($segments);

            $lastSegment = array_reduce($segments, fn (Model $model, string $key)
                    => $model ?
                    $model->{$key}
                    : null,
                    $model);

            if($lastSegment)
            {
                $lastSegment->append($appendKey);
            }
        } else {
            $model->append($key);
        }
    }
}