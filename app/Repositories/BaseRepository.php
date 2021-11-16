<?php

namespace App\Repositories;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

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

    /** @var string $notFoundMessage */
    protected string $notFoundMessage;

    /** @var string $storeRequest */
    public string $storeRequest;

    /** @var string $updateRequest */
    public string $updateRequest;

    public function __construct()
    {
        $this->notFoundMessage = $this->getModelName() . ' not found in the DB';
    }

    /**
     * Get all <model>
     *
     * @method GET api/<model>
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Collection
     * @throws $notFoundException
     */
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
            throw new $this->notFoundException($this->notFoundMessage);
        }

        return $results;
    }

    /**
     * Get <model> by id
     *
     * @param int $id
     *
     * @method GET api/<model>/{id}
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws $notFoundException
     */
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
            throw new $this->notFoundException($this->notFoundMessage);
        }

        return $instance;
    }

    /**
     * Store a new <model>
     *
     * @param array $attributes
     *
     * @method POST api/<model>
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws Exception
     */
    public function store(array $attributes = []):Model
    {
        $model = $this->getModel();
        $builder = $model::query();
        DB::beginTransaction();

        try{
            if(isset($attributes['password']))
            {
                $attributes['password'] = Hash::make($attributes['password']);
            }
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

    /**
     * Update a <model>
     *
     * @param int $id
     * @param array $attributes = []
     *
     * @method PUT api/<model>/{id}
     * @access public
     *
     * @return \Illuminate\Database\Eloquent\Model
     * @throws Exception
     */
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

        /**
     * Delete a <model>
     *
     * @param int $id
     *
     * @method DELETE api/<model>/{id}
     * @access public
     *
     * @return void
     * @throws Exception
     */
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

    private function getModelName():string
    {
        $model_split_class = explode('\\', $this->model);
        return end($model_split_class);
    }
}