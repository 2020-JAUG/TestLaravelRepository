<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\UserRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Models\User;
use App\Traits\ResponseApi;
use Exception;

class UserController extends Controller
{
    use ResponseApi;

    const USER_NOT_FOUND_MESSAGE = 'User not found';
    const INTERNAL_ERROR_MESSAGE = 'Internal error';

    protected UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allUsers = $this->repository->index();
        return $this->success('Ok', $allUsers, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        try{
            $newUser = new User($request->all());
            $newUser = $this->repository->store($newUser);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('User stored', $newUser, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $user = $this->repository->show($id);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $user, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByName(UserRequest $request)
    {
        try{
            $nameParam = strtolower($request->input('name'));
            $user = $this->repository->showByName($nameParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $user, 200);
    }

    /**
     * Display de specified resource
     *
     * @param \App\Http\Requests\UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByEmail(UserRequest $request)
    {
        try{
            $emailParam = strtolower($request->input('email'));
            $user = $this->repository->showByEmail($emailParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $user, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, int $id)
    {
        try{
            $userToUpdate = new User($request->all());
            $userToUpdate = $this->repository->update($id, $userToUpdate);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('Ok', $userToUpdate, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $this->repository->delete($id);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('User deleted', [], 200);
    }
}