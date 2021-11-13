<?php

namespace App\Repositories;

use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
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

    public function store(Model $customer): Customer
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

    public function update(int $id, Model $customer): Customer
    {
        $customerToUpdate = $this->show($id);
        DB::beginTransaction();
        try{
            foreach($customerToUpdate as $key => $value)
            {
                if($customerToUpdate->$key != $customer->$key)
                {
                    $customerToUpdate->$key = $customer->$key;
                }
                $customerToUpdate->update();
                DB::commit();
            }
        }catch(Exception $ex){
            DB::rollBack();
        }
        return $customerToUpdate;
    }

    public function delete(int $id): void
    {
        $customerToDelete = $this->show($id);
        DB::beginTransaction();
        try{
            $customerToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
        }
    }
}