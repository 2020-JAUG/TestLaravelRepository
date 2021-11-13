<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
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
        $customer = $this->repository->store(new Customer($request->all()));
        if(!$customer)
        {
            return response(self::INTERNAL_ERROR_MESSAGE, 500);
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
        $customer = $this->repository->show($id);
        if(!$customer)
        {
            return response(self::CUSTOMER_NOT_FOUNT_MESSAGE, 500);
        }
        return response($customer, 200);
    }

    public function showByName(Request $request)
    {
        $customer = $this->repository->showByName($request->first_name);
        if(!$customer)
        {
            return response(self::CUSTOMER_NOT_FOUNT_MESSAGE, 400);
        }
        return response($customer, 200);
    }

    public function showByUser(int $userId)
    {
        $customer = $this->repository->showByUser($userId);
        if(!$customer)
        {
            return response(self::CUSTOMER_NOT_FOUNT_MESSAGE, 400);
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
        $customerUpdated = $this->repository->update($id, new Customer($request->all()));
        echo($customerUpdated);
        if(!$customerUpdated)
        {
            return response(self::INTERNAL_ERROR_MESSAGE, 500);
        }
        return response($customerUpdated, 204);
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