<?php

namespace App\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use SebastianBergmann\Type\ObjectType;

interface BaseRepositoryInterface
{
    /**
     * Get all <model>
     *
     * @method GET api/<model>
     * @access public
     */
    public function index();

    /**
     * Get <model> by id
     *
     * @param int $id
     *
     * @method GET api/<model>/{id}
     * @access public
     */
    public function show(int $id);

    /**
     * Store a <model>
     *
     * @param App\Http\Models\<model> $model
     *
     * @method POST api/<model>
     * @access public
     */
    public function store(array $attributes = []);

    /**
     * Update a <model>
     *
     * @param int $id
     * @param App\Http\Models\<model> $model
     *
     * @method PUT api/<model>/{id}
     * @access public
     */
    public function update(int $id, array $attributes = []);

    /**
     * Delete a <model>
     *
     * @param int $id
     *
     * @method DELETE api/<model>/{id}
     * @access public
     */
    public function delete(int $id);
}