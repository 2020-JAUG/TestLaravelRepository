<?php

namespace App\Repositories;

use App\Exceptions\Customer\CustomerNotFoundException;
use App\Interfaces\CustomerRepositoryInterface;
use App\Models\Customer;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

final class CustomerRepositoryImpl implements CustomerRepositoryInterface
{
    const CUSTOMER_NOT_FOUND_MESSAGE = 'Customer not found';

    /**
     * Get all Customers
     *
     * @method GET api/customer
     * @access public
     *
     * @return Collection<Customer>
     */
    public function index(): Collection
    {
        return Customer::with('user')->get();
    }

    /**
     * Get Customer by id
     *
     * @param int $id
     *
     * @method GET api/{id}
     * @access public
     *
     * @return App\Http\Models\Customer
     * @throws CustomerNotFoundException
     */
    public function show(int $id): Customer
    {
        $customer = null;
        try{
            $customer = Customer::findOrFail($id);
        } catch(Exception $ex){
            throw new CustomerNotFoundException(self::CUSTOMER_NOT_FOUND_MESSAGE);
        }
        return $customer;
    }

    /**
     * Get Customer by name attribute
     *
     * @param string $name
     *
     * @method GET
     * @access public
     *
     * @return App\Http\Models\Customer
     * @throws CustomerNotFoundException
     */
    public function showByName(string $name): Customer
    {
        $customer = null;
        try{
            $customer = Customer::where('first_name', $name)->firstOrFail();
        } catch(Exception $ex){
            throw new CustomerNotFoundException(self::CUSTOMER_NOT_FOUND_MESSAGE);
        }
        return $customer;
    }

    /**
     * Get Customer by User id
     *
     * @param int $id
     *
     * @method GET
     * @access public
     *
     * @return Collection<Customer>
     * @throws CustomerNotFoundException
     */
    public function showByUser(int $id): Collection
    {
        $customers = null;
        try{
            $customers = Customer::where('user_id', $id)->get();
        }catch(Exception $ex){
            throw new CustomerNotFoundException(self::CUSTOMER_NOT_FOUND_MESSAGE);
        }
        return $customers;
    }

    /**
     * Save a new Customer
     *
     * @param App\Models\Customer $customer
     *
     * @method POST api/customer
     * @access public
     *
     * @return App\Models\Customer
     * @throws Exception
     */
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
            throw $ex;
        }
        return $newCustomer;
    }

    /**
     * Update a Customer
     *
     * @param int $id
     * @param App\Models\Customer
     *
     * @method PUT
     * @access public
     *
     * @return App\Models\Customer
     * @throws Exception
     */
    public function update(int $id, Model $customer): Customer
    {
        $customerToUpdate = $this->show($id);
        DB::beginTransaction();
        try{
            foreach($customer->toArray() as $key => $value)
            {
                if(isset($customer[$key]))
                {
                    $customerToUpdate->$key = $customer[$key];
                }
                $customerToUpdate->update();
                DB::commit();
            }
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
        return $customerToUpdate;
    }

    /**
     * Delete a Customer
     *
     * @param int $id
     *
     * @method DELETE
     * @access public
     *
     * @return void
     * @throws Exception
     */
    public function delete(int $id): void
    {
        $customerToDelete = $this->show($id);
        DB::beginTransaction();
        try{
            $customerToDelete->delete();
            DB::commit();
        }catch(Exception $ex){
            DB::rollBack();
            throw $ex;
        }
    }
}