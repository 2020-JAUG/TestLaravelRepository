<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
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
        return response($customers, 200);
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
    public function store(CustomerRequest $request)
    {
        try{
            $newCustomer = new Customer($request->all());
            $customer = $this->repository->store($newCustomer);
        }catch(Exception $ex){
            return response($ex->getMessage(), 500);
        }
        return response($customer, 201);
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
            return response($ex->getMessage(), 400);
        }
        return response($customer, 200);
    }

    /**
     * Display the specified resource
     *
     * @param \App\Http\Requests\CustomerRequest
     */
    public function showByName(CustomerRequest $request)
    {
        try{
            $customer = $this->repository->showByName($request->input('first_name'));
        }catch(Exception $ex){
            return response($ex->getMessage(), 400);
        }
        return response($customer, 200);
    }

    public function showByUser(int $userId)
    {
        try{
            $customer = $this->repository->showByUser($userId);
        }catch(Exception $ex){
            return response($ex->getMessage(), 400);
        }
        return response($customer, 200);
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
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, int $id)
    {
        $customerUpdated = new Customer($request->all());
        $customerUpdated = $this->repository->update($id, $customerUpdated);
        if(!$customerUpdated)
        {
            return response(self::INTERNAL_ERROR_MESSAGE, 500);
        }
        return response($customerUpdated, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->repository->delete($id);
        return response(self::CUSTOMER_DELETED_MESSAGE, 200);
    }
}
