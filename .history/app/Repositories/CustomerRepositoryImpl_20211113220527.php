<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

final class CustomerRepositoryImpl implements CustomerRepositoryInterface
{
    public function index(): Collection
    {
        return Customer::all();
    }

    public function show(int $id): Customer
    {
        $customer = null;
        try{
            $customer = Customer::findOrFail($id);
        } catch(Exception $ex){

        }
        return $customer;
    }

    public function showByName(string $name): Customer
    {
        $customer = null;
        try{
            $customer = Customer::where('first_name', $name)->firstOrFail();
        } catch(Exception $ex){

        }
        return $customer;
    }

    public function showByUser(int $id): Collection
    {
        $customers = null;
        try{
            $customers = Customer::where('user_id.id', $id)->get();
        }catch(Exception $ex){

        }
        return $customers;
    }

    public function store(Customer $customer): Customer
    {
        $newCustomer = null;
        DB::beginTransaction();
        try{
            $newCustomer = $customer;
            $newCustomer->save();
            DB::commit();
        } catch(Exception $ex){
            DB::rollBack();
        }
        return $newCustomer;
    }

    public function update(int $id, Customer $customer): Customer
    {
        $customerToUpdate = $this->show($id);
        DB::beginTransaction();
        try{
            forech($customerToUpdate as $key => $value)
            {

            }
        }
    }
}