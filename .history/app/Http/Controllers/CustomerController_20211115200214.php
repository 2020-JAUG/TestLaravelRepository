<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;
use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use App\Traits\ResponseApi;
use Exception;

class CustomerController extends Controller
{
    use ResponseApi;

    const CUSTOMER_NOT_FOUNT_MESSAGE = 'Customer not found';
    const CUSTOMER_DELETED_MESSAGE = 'Customer deleted';
    const INTERNAL_ERROR_MESSAGE = 'Internal error';

    protected CustomerRepositoryInterface $repository;

    public function __construct(CustomerRepositoryInterface $repository)
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
        $customers = $this->repository->index();
        return $this->success('Ok', $customers, 200);
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
    public function store(StoreCustomerRequest $request)
    {
        try{
            $newCustomer = new Customer($request->all());
            $customer = $this->repository->store($newCustomer);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('Customer stored', $customer, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try{
            $customer = $this->repository->show($id);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $customer, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\CustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function showByName(CustomerRequest $request)
    {
        try{
            $first_nameParam = strtolower($request->input('first_name'));
            $customer = $this->repository->showByName($first_nameParam);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $customer, 200);
    }

    /**
     * Display the specified resource
     *
     * @param int $userId
     * @return \Illuminate\Http\Response
     */
    public function showByUser(int $userId)
    {
        try{
            $customer = $this->repository->showByUser($userId);
        }catch(Exception $ex){
            return $this->error($ex->getMessage(), 400);
        }
        return $this->success('Ok', $customer, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CustomerRequest  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, int $id)
    {
        try{
            $customerUpdated = new Customer($request->all());
            $customerUpdated = $this->repository->update($id, $customerUpdated);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success('Customer updated', $customerUpdated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        try{
            $this->repository->delete($id);
        }catch(Exception $ex){
            return $this->error($ex->getMessage());
        }
        return $this->success(self::CUSTOMER_DELETED_MESSAGE, [], 200);
    }
}